<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Tests\Feature;

use WallaceMartinss\FilamentEvolution\Models\WhatsappInstance;
use WallaceMartinss\FilamentEvolution\Tests\TestCase;

class WebhookControllerTest extends TestCase
{
    public function test_webhook_endpoint_returns_success(): void
    {
        // Create a test instance
        WhatsappInstance::create([
            'name' => 'test-instance',
            'phone' => '5511999999999',
            'status' => 'close',
        ]);

        $payload = [
            'event' => 'connection.update',
            'instance' => 'test-instance',
            'data' => [
                'state' => 'open',
            ],
        ];

        $response = $this->postJson(
            route('filament-evolution.webhook'),
            $payload
        );

        $response->assertOk();
        $response->assertJson(['success' => true]);
    }

    public function test_webhook_endpoint_rejects_unauthorized_request_when_secret_configured(): void
    {
        config(['filament-evolution.webhook.secret' => 'super-secret']);

        $payload = [
            'event' => 'connection.update',
            'instance' => 'test-instance',
        ];

        $response = $this->postJson(
            route('filament-evolution.webhook'),
            $payload
        );

        $response->assertUnauthorized();
    }

    public function test_webhook_endpoint_accepts_authorized_request_with_secret(): void
    {
        config(['filament-evolution.webhook.secret' => 'super-secret']);

        // Create a test instance
        WhatsappInstance::create([
            'name' => 'test-instance',
            'phone' => '5511999999999',
            'status' => 'close',
        ]);

        $payload = [
            'event' => 'connection.update',
            'instance' => 'test-instance',
            'data' => [
                'state' => 'open',
            ],
        ];

        $response = $this->postJson(
            route('filament-evolution.webhook'),
            $payload,
            ['X-Webhook-Secret' => 'super-secret']
        );

        $response->assertOk();
    }
}
