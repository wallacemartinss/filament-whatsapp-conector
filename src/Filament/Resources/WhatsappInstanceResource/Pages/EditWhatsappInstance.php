<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Filament\Resources\WhatsappInstanceResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use WallaceMartinss\FilamentEvolution\Filament\Resources\WhatsappInstanceResource;

class EditWhatsappInstance extends EditRecord
{
    protected static string $resource = WhatsappInstanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title(__('filament-evolution::resource.messages.updated'));
    }
}
