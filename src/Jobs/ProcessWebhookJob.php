<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use WallaceMartinss\FilamentEvolution\Data\Webhooks\ConnectionUpdateData;
use WallaceMartinss\FilamentEvolution\Data\Webhooks\MessageUpsertData;
use WallaceMartinss\FilamentEvolution\Data\Webhooks\QrCodeUpdatedData;
use WallaceMartinss\FilamentEvolution\Enums\WebhookEventEnum;
use WallaceMartinss\FilamentEvolution\Events\InstanceConnected;
use WallaceMartinss\FilamentEvolution\Events\InstanceDisconnected;
use WallaceMartinss\FilamentEvolution\Events\MessageReceived;
use WallaceMartinss\FilamentEvolution\Events\QrCodeUpdated;
use WallaceMartinss\FilamentEvolution\Models\WhatsappInstance;
use WallaceMartinss\FilamentEvolution\Models\WhatsappWebhook;

class ProcessWebhookJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public int $tries = 3;

    public int $backoff = 30;

    public function __construct(
        public string $event,
        public array $payload,
        public ?int $webhookId = null,
    ) {
        $this->onQueue(config('filament-evolution.queue.name', 'default'));
    }

    public function handle(): void
    {
        try {
            $instanceName = $this->payload['instance'] ?? $this->payload['instanceName'] ?? null;

            if (! $instanceName) {
                $this->markWebhookFailed('No instance name in payload');

                return;
            }

            $instance = WhatsappInstance::where('name', $instanceName)->first();

            if (! $instance) {
                $this->markWebhookFailed("Instance not found: {$instanceName}");

                return;
            }

            $this->processEvent($instance);
            $this->markWebhookProcessed();
        } catch (\Throwable $e) {
            $this->markWebhookFailed($e->getMessage());

            if (config('filament-evolution.logging.webhook_errors', true)) {
                Log::channel(config('filament-evolution.logging.channel', 'stack'))
                    ->error('Webhook processing failed', [
                        'event' => $this->event,
                        'error' => $e->getMessage(),
                        'payload' => $this->payload,
                    ]);
            }

            throw $e;
        }
    }

    protected function processEvent(WhatsappInstance $instance): void
    {
        $eventEnum = WebhookEventEnum::tryFrom($this->event);

        match ($eventEnum) {
            WebhookEventEnum::CONNECTION_UPDATE => $this->handleConnectionUpdate($instance),
            WebhookEventEnum::QRCODE_UPDATED => $this->handleQrCodeUpdated($instance),
            WebhookEventEnum::MESSAGES_UPSERT => $this->handleMessageUpsert($instance),
            WebhookEventEnum::MESSAGES_UPDATE => $this->handleMessageUpdate($instance),
            default => $this->handleUnknownEvent($instance),
        };
    }

    protected function handleConnectionUpdate(WhatsappInstance $instance): void
    {
        $data = ConnectionUpdateData::fromWebhook($this->payload);

        $instance->update([
            'status' => $data->status,
        ]);

        if ($data->isConnected()) {
            event(new InstanceConnected($instance));
        } else {
            event(new InstanceDisconnected($instance, $data->state));
        }
    }

    protected function handleQrCodeUpdated(WhatsappInstance $instance): void
    {
        $data = QrCodeUpdatedData::fromWebhook($this->payload);

        $instance->update([
            'qr_code' => $data->base64,
            'pairing_code' => $data->pairingCode,
            'qr_code_updated_at' => now(),
        ]);

        event(new QrCodeUpdated(
            $instance,
            new \WallaceMartinss\FilamentEvolution\Data\QrCodeData(
                code: $data->code,
                base64: $data->base64,
                pairingCode: $data->pairingCode,
            )
        ));
    }

    protected function handleMessageUpsert(WhatsappInstance $instance): void
    {
        $data = MessageUpsertData::fromWebhook($this->payload);

        // Store message in database if enabled
        if (config('filament-evolution.storage.messages', true)) {
            // Extract remoteJid from payload
            $messageData = $this->payload['data'] ?? $this->payload;
            $key = $messageData['key'] ?? [];
            $remoteJid = $key['remoteJid'] ?? $data->message->phone;

            $instance->messages()->create([
                'message_id' => $data->message->messageId,
                'remote_jid' => $remoteJid,
                'phone' => $data->message->phone,
                'direction' => $data->message->direction,
                'type' => $data->message->type,
                'content' => [
                    'text' => $data->message->text,
                    'media_url' => $data->message->mediaUrl,
                    'media_caption' => $data->message->mediaCaption,
                    'latitude' => $data->message->latitude,
                    'longitude' => $data->message->longitude,
                ],
                'status' => $data->message->status,
                'raw_payload' => $this->payload,
            ]);
        }

        event(new MessageReceived($instance, $data->message));
    }

    protected function handleMessageUpdate(WhatsappInstance $instance): void
    {
        // Only update if message storage is enabled
        if (! config('filament-evolution.storage.messages', true)) {
            return;
        }

        $messageData = $this->payload['data'] ?? $this->payload;
        $key = $messageData['key'] ?? [];
        $update = $messageData['update'] ?? [];

        if (isset($key['id']) && isset($update['status'])) {
            $instance->messages()
                ->where('message_id', $key['id'])
                ->update([
                    'status' => $this->mapMessageStatus($update['status']),
                ]);
        }
    }

    protected function handleUnknownEvent(WhatsappInstance $instance): void
    {
        if (config('filament-evolution.logging.webhook_events', false)) {
            Log::channel(config('filament-evolution.logging.channel', 'stack'))
                ->info('Unknown webhook event received', [
                    'event' => $this->event,
                    'instance' => $instance->name,
                ]);
        }
    }

    protected function mapMessageStatus(int $status): string
    {
        return match ($status) {
            0 => 'pending',
            1 => 'sent',
            2 => 'delivered',
            3, 4 => 'read',
            default => 'pending',
        };
    }

    protected function markWebhookProcessed(): void
    {
        if ($this->webhookId) {
            WhatsappWebhook::where('id', $this->webhookId)->update([
                'processed' => true,
            ]);
        }
    }

    protected function markWebhookFailed(string $error): void
    {
        if ($this->webhookId) {
            WhatsappWebhook::where('id', $this->webhookId)->update([
                'error' => $error,
            ]);
        }
    }
}
