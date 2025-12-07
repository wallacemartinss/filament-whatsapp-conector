<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use WallaceMartinss\FilamentEvolution\Jobs\ProcessWebhookJob;
use WallaceMartinss\FilamentEvolution\Models\WhatsappWebhook;

class WebhookController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        // Verify webhook secret if configured
        if (! $this->verifyWebhookSecret($request)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $payload = $request->all();
        $event = $payload['event'] ?? $request->header('X-Evolution-Event') ?? 'unknown';

        // Log incoming webhook if enabled
        if (config('filament-evolution.logging.webhook_events', false)) {
            Log::channel(config('filament-evolution.logging.channel', 'stack'))
                ->info('Webhook received', [
                    'event' => $event,
                    'instance' => $payload['instance'] ?? $payload['instanceName'] ?? 'unknown',
                ]);
        }

        // Store webhook in database if enabled
        $webhook = null;
        if (config('filament-evolution.storage.webhooks', true)) {
            $webhook = $this->storeWebhook($event, $payload);
        }

        // Dispatch job to process webhook
        if (config('filament-evolution.queue.enabled', true)) {
            ProcessWebhookJob::dispatch($event, $payload, $webhook?->id);
        } else {
            ProcessWebhookJob::dispatchSync($event, $payload, $webhook?->id);
        }

        return response()->json(['success' => true]);
    }

    protected function verifyWebhookSecret(Request $request): bool
    {
        $secret = config('filament-evolution.webhook.secret');

        if (empty($secret)) {
            return true;
        }

        $headerSecret = $request->header('X-Webhook-Secret')
            ?? $request->header('Authorization');

        if ($headerSecret && str_starts_with($headerSecret, 'Bearer ')) {
            $headerSecret = substr($headerSecret, 7);
        }

        return $headerSecret === $secret;
    }

    protected function storeWebhook(string $event, array $payload): WhatsappWebhook
    {
        $instanceName = $payload['instance'] ?? $payload['instanceName'] ?? null;
        $instance = null;

        if ($instanceName) {
            $instance = \WallaceMartinss\FilamentEvolution\Models\WhatsappInstance::where('name', $instanceName)->first();
        }

        return WhatsappWebhook::create([
            'instance_id' => $instance?->id,
            'event' => $event,
            'payload' => $payload,
        ]);
    }
}
