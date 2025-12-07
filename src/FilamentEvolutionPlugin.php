<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution;

use Filament\Contracts\Plugin;
use Filament\Panel;
use WallaceMartinss\FilamentEvolution\Filament\Resources\WhatsappInstanceResource;
use WallaceMartinss\FilamentEvolution\Filament\Resources\WhatsappMessageResource;
use WallaceMartinss\FilamentEvolution\Filament\Resources\WhatsappWebhookResource;

class FilamentEvolutionPlugin implements Plugin
{
    protected bool $hasWhatsappInstanceResource = true;

    protected bool $hasWhatsappMessageResource = false;

    protected bool $hasWhatsappWebhookResource = false;

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
        $resources = [];

        if ($this->hasWhatsappInstanceResource) {
            $resources[] = WhatsappInstanceResource::class;
        }

        if ($this->hasWhatsappMessageResource) {
            $resources[] = WhatsappMessageResource::class;
        }

        if ($this->hasWhatsappWebhookResource) {
            $resources[] = WhatsappWebhookResource::class;
        }

        if (! empty($resources)) {
            $panel->resources($resources);
        }
    }

    public function boot(Panel $panel): void
    {
        //
    }

    /**
     * Enable or disable the WhatsApp Instance resource.
     */
    public function whatsappInstanceResource(bool $condition = true): static
    {
        $this->hasWhatsappInstanceResource = $condition;

        return $this;
    }

    /**
     * Enable the Message History resource to view all messages.
     */
    public function viewMessageHistory(bool $condition = true): static
    {
        $this->hasWhatsappMessageResource = $condition;

        return $this;
    }

    /**
     * Enable the Webhook Logs resource to view all webhook events.
     */
    public function viewWebhookLogs(bool $condition = true): static
    {
        $this->hasWhatsappWebhookResource = $condition;

        return $this;
    }
}
