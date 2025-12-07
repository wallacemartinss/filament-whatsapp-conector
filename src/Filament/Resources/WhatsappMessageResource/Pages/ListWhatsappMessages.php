<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Filament\Resources\WhatsappMessageResource\Pages;

use Filament\Resources\Pages\ListRecords;
use WallaceMartinss\FilamentEvolution\Filament\Resources\WhatsappMessageResource;

class ListWhatsappMessages extends ListRecords
{
    protected static string $resource = WhatsappMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
