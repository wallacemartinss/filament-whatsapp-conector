<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Tests;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as Orchestra;
use WallaceMartinss\FilamentEvolution\FilamentEvolutionServiceProvider;

abstract class TestCase extends Orchestra
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();
    }

    protected function setUpDatabase(): void
    {
        // Create whatsapp_instances table
        if (! Schema::hasTable('whatsapp_instances')) {
            Schema::create('whatsapp_instances', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name')->unique();
                $table->string('phone')->nullable();
                $table->string('status')->default('close');
                $table->string('profile_name')->nullable();
                $table->string('profile_picture_url')->nullable();
                $table->json('settings')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Create whatsapp_webhooks table
        if (! Schema::hasTable('whatsapp_webhooks')) {
            Schema::create('whatsapp_webhooks', function (Blueprint $table) {
                $table->id();
                $table->uuid('instance_id')->nullable();
                $table->string('event');
                $table->json('payload');
                $table->boolean('processed')->default(false);
                $table->text('error')->nullable();
                $table->integer('processing_time_ms')->nullable();
                $table->timestamps();

                $table->index('event');
                $table->index('processed');
            });
        }

        // Create whatsapp_messages table
        if (! Schema::hasTable('whatsapp_messages')) {
            Schema::create('whatsapp_messages', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('instance_id');
                $table->string('remote_jid');
                $table->string('message_id')->unique();
                $table->boolean('from_me')->default(false);
                $table->string('message_type')->default('text');
                $table->text('content')->nullable();
                $table->json('media')->nullable();
                $table->string('status')->default('pending');
                $table->timestamp('message_timestamp')->nullable();
                $table->timestamps();

                $table->index('remote_jid');
                $table->index('message_type');
                $table->index('status');
            });
        }
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
