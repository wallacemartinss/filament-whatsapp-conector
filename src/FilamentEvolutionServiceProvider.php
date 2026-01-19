<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution;

use Livewire\Livewire;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use WallaceMartinss\FilamentEvolution\Console\Commands\CleanupCommand;
use WallaceMartinss\FilamentEvolution\Livewire\QrCodeDisplay;
use WallaceMartinss\FilamentEvolution\Services\EvolutionClient;
use WallaceMartinss\FilamentEvolution\Services\WhatsappService;

class FilamentEvolutionServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-evolution';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasConfigFile()
            ->hasMigrations([
                'create_whatsapp_instances_table',
                'create_whatsapp_messages_table',
                'create_whatsapp_webhooks_table',
            ])
            ->hasViews()
            ->hasTranslations()
            ->hasRoutes(['api'])
            ->hasCommand(CleanupCommand::class)
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->askToRunMigrations()
                    ->askToStarRepoOnGitHub('wallacemartinss/filament-whatsapp-conector');
            });
    }

    public function packageRegistered(): void
    {
        $this->app->singleton(EvolutionClient::class, function () {
            return new EvolutionClient;
        });

        $this->app->singleton(WhatsappService::class, function ($app) {
            return new WhatsappService($app->make(EvolutionClient::class));
        });
    }

    public function packageBooted(): void
    {
        // Livewire v4 - register without :: namespace
        Livewire::component('filament-evolution.qr-code-display', QrCodeDisplay::class);
    }
}
