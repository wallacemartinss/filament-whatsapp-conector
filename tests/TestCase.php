<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as Orchestra;
use WallaceMartinss\FilamentEvolution\FilamentEvolutionServiceProvider;

abstract class TestCase extends Orchestra
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    protected function getPackageProviders($app): array
    {
        return [
            FilamentEvolutionServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $app['config']->set('filament-evolution.api.base_url', 'https://api.evolution.test');
        $app['config']->set('filament-evolution.api.api_key', 'test-api-key');
        $app['config']->set('filament-evolution.tenancy.enabled', false);
    }
}
