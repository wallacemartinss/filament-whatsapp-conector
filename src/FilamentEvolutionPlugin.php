<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution;

use Filament\Contracts\Plugin;
use Filament\Panel;
use WallaceMartinss\FilamentEvolution\Filament\Resources\WhatsappInstanceResource;

class FilamentEvolutionPlugin implements Plugin
{
    protected bool $hasWhatsappInstanceResource = true;

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }

    public function getId(): string
    {
        return 'filament-evolution';
    }

    public function register(Panel $panel): void
    {
        if ($this->hasWhatsappInstanceResource) {
            $panel->resources([
                WhatsappInstanceResource::class,
            ]);
        }
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public function whatsappInstanceResource(bool $condition = true): static
    {
        $this->hasWhatsappInstanceResource = $condition;

        return $this;
    }
}
