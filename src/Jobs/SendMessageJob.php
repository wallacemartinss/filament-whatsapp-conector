<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use WallaceMartinss\FilamentEvolution\Enums\MessageStatusEnum;
use WallaceMartinss\FilamentEvolution\Enums\MessageTypeEnum;
use WallaceMartinss\FilamentEvolution\Exceptions\EvolutionApiException;
use WallaceMartinss\FilamentEvolution\Models\WhatsappInstance;
use WallaceMartinss\FilamentEvolution\Models\WhatsappMessage;
use WallaceMartinss\FilamentEvolution\Services\EvolutionClient;

class SendMessageJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public int $tries = 3;

    public int $backoff = 10;

    public function __construct(
        public WhatsappInstance $instance,
        public string $phone,
        public MessageTypeEnum $type,
        public array $content,
        public ?int $messageId = null,
    ) {
        $this->onQueue(config('filament-evolution.queue.name', 'default'));
    }

    public function handle(EvolutionClient $client): void
    {
        try {
            $response = $this->sendMessage($client);

            if ($this->messageId) {
                $this->updateMessageStatus(MessageStatusEnum::SENT, $response);
            }
        } catch (EvolutionApiException $e) {
            if ($this->messageId) {
                $this->updateMessageStatus(MessageStatusEnum::FAILED);
            }

            Log::channel(config('filament-evolution.logging.channel', 'stack'))
                ->error('Failed to send WhatsApp message', [
                    'instance' => $this->instance->name,
                    'phone' => $this->phone,
                    'type' => $this->type->value,
                    'error' => $e->getMessage(),
                ]);

            throw $e;
        }
    }

    protected function sendMessage(EvolutionClient $client): array
    {
        return match ($this->type) {
            MessageTypeEnum::TEXT => $client->sendText(
                $this->instance->name,
                $this->phone,
                $this->content['text'] ?? '',
            ),
            MessageTypeEnum::IMAGE => $client->sendImage(
                $this->instance->name,
                $this->phone,
                $this->content['url'] ?? '',
                $this->content['caption'] ?? null,
            ),
            MessageTypeEnum::AUDIO => $client->sendAudio(
                $this->instance->name,
                $this->phone,
                $this->content['url'] ?? '',
            ),
            MessageTypeEnum::DOCUMENT => $client->sendDocument(
                $this->instance->name,
                $this->phone,
                $this->content['url'] ?? '',
                $this->content['fileName'] ?? 'document',
                $this->content['caption'] ?? null,
            ),
            MessageTypeEnum::LOCATION => $client->sendLocation(
                $this->instance->name,
                $this->phone,
                $this->content['latitude'] ?? 0.0,
                $this->content['longitude'] ?? 0.0,
                $this->content['name'] ?? null,
                $this->content['address'] ?? null,
            ),
            MessageTypeEnum::CONTACT => $client->sendContact(
                $this->instance->name,
                $this->phone,
                $this->content['contactName'] ?? '',
                $this->content['contactNumber'] ?? '',
            ),
            default => throw new EvolutionApiException("Unsupported message type: {$this->type->value}"),
        };
    }

    protected function updateMessageStatus(MessageStatusEnum $status, ?array $response = null): void
    {
        $update = ['status' => $status];

        if ($response && isset($response['key']['id'])) {
            $update['message_id'] = $response['key']['id'];
        }

        WhatsappMessage::where('id', $this->messageId)->update($update);
    }
}
