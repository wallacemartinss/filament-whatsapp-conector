<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Tests\Unit;

use WallaceMartinss\FilamentEvolution\Services\EvolutionClient;
use WallaceMartinss\FilamentEvolution\Tests\TestCase;

class EvolutionClientTest extends TestCase
{
    public function test_client_can_be_instantiated(): void
    {
        $client = new EvolutionClient;

        $this->assertInstanceOf(EvolutionClient::class, $client);
    }

    public function test_client_is_configured_when_has_url_and_key(): void
    {
        $client = new EvolutionClient;

        $this->assertTrue($client->isConfigured());
    }

    public function test_client_returns_configured_base_url(): void
    {
        $client = new EvolutionClient;

        $this->assertSame('https://api.evolution.test', $client->getBaseUrl());
    }
}
