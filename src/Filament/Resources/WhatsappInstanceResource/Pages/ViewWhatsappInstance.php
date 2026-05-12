<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Filament\Resources\WhatsappInstanceResource\Pages;

use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Icons\Heroicon;
use WallaceMartinss\FilamentEvolution\Enums\StatusConnectionEnum;
use WallaceMartinss\FilamentEvolution\Exceptions\EvolutionApiException;
use WallaceMartinss\FilamentEvolution\Filament\Resources\WhatsappInstanceResource;
use WallaceMartinss\FilamentEvolution\Services\EvolutionClient;

class ViewWhatsappInstance extends ViewRecord
{
    protected static string $resource = WhatsappInstanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('connect')
                ->label(__('filament-evolution::resource.actions.connect'))
                ->icon(Heroicon::QrCode)
                ->color('success')
                ->visible(fn () => $this->record->status !== StatusConnectionEnum::OPEN)
                ->modalHeading(__('filament-evolution::resource.actions.view_qrcode'))
                ->modalContent(fn () => view('filament-evolution::components.qr-code-modal', [
                    'instance' => $this->record,
                ]))
                ->modalWidth('md')
                ->modalSubmitAction(false)
                ->modalCancelActionLabel(__('filament-evolution::resource.actions.close')),

            Action::make('disconnect')
                ->label(__('filament-evolution::resource.actions.disconnect'))
                ->icon(Heroicon::XCircle)
                ->color('danger')
                ->visible(fn () => $this->record->status === StatusConnectionEnum::OPEN)
                ->requiresConfirmation()
                ->action(function () {
                    try {
                        $client = app(EvolutionClient::class);
                        $client->logoutInstance($this->record->name);

                        $this->record->update([
                            'status' => StatusConnectionEnum::CLOSE,
                        ]);

                        Notification::make()
                            ->success()
                            ->title(__('filament-evolution::resource.messages.disconnected'))
                            ->send();
                    } catch (EvolutionApiException $e) {
                        Notification::make()
                            ->danger()
                            ->title(__('filament-evolution::resource.messages.connection_failed'))
                            ->body($e->getMessage())
                            ->send();
                    }
                }),

            Action::make('refresh')
                ->label(__('filament-evolution::resource.actions.refresh'))
                ->icon(Heroicon::ArrowPath)
                ->color('gray')
                ->action(function () {
                    try {
                        $client = app(EvolutionClient::class);

                        // First try to fetch instance to check if it exists
                        $instances = $client->fetchInstance($this->record->name);

                        if (empty($instances)) {
                            // Instance doesn't exist in API, try to create it
                            $client->createInstance(
                                instanceName: $this->record->name,
                                number: $this->record->number,
                                qrcode: false
                            );

                            Notification::make()
                                ->success()
                                ->title('Instance created in Evolution API')
                                ->send();

                            return;
                        }

                        // Extract profile picture URL from fetchInstance response
                        $instanceData = is_array($instances) ? ($instances[0] ?? $instances) : $instances;
                        $profilePictureUrl = $instanceData['profilePicUrl']
                            ?? $instanceData['instance']['profilePicUrl']
                            ?? null;

                        // Instance exists, check connection state
                        $state = $client->getConnectionState($this->record->name);

                        $connectionState = $state['state'] ?? $state['instance']['state'] ?? 'close';
                        $status = match (strtolower($connectionState)) {
                            'open', 'connected' => StatusConnectionEnum::OPEN,
                            'connecting' => StatusConnectionEnum::CONNECTING,
                            default => StatusConnectionEnum::CLOSE,
                        };

                        $this->record->update([
                            'status' => $status,
                            'profile_picture_url' => $profilePictureUrl,
                        ]);

                        Notification::make()
                            ->success()
                            ->title(__('filament-evolution::resource.fields.status').': '.$status->getLabel())
                            ->send();
                    } catch (EvolutionApiException $e) {
                        // If 404, instance doesn't exist - try to create it
                        if (str_contains($e->getMessage(), 'Not Found') || $e->getCode() === 404) {
                            try {
                                $client = app(EvolutionClient::class);
                                $client->createInstance(
                                    instanceName: $this->record->name,
                                    number: $this->record->number,
                                    qrcode: false
                                );

                                Notification::make()
                                    ->success()
                                    ->title('Instance created in Evolution API')
                                    ->send();

                                return;
                            } catch (EvolutionApiException $createError) {
                                Notification::make()
                                    ->danger()
                                    ->title('Failed to create instance')
                                    ->body($createError->getMessage())
                                    ->send();

                                return;
                            }
                        }

                        Notification::make()
                            ->danger()
                            ->title(__('filament-evolution::resource.messages.connection_failed'))
                            ->body($e->getMessage())
                            ->send();
                    }
                }),

            EditAction::make(),
            DeleteAction::make(),
        ];
    }
}
