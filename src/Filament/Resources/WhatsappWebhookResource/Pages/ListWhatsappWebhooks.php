<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Filament\Resources\WhatsappWebhookResource\Pages;

use Filament\Resources\Pages\ListRecords;
use WallaceMartinss\FilamentEvolution\Filament\Resources\WhatsappWebhookResource;

class ListWhatsappWebhooks extends ListRecords
{
    protected static string $resource = WhatsappWebhookResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
