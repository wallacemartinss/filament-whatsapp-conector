<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Filament\Resources\WhatsappWebhookResource\Pages;

use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use WallaceMartinss\FilamentEvolution\Filament\Resources\WhatsappWebhookResource;

class ViewWhatsappWebhook extends ViewRecord
{
    protected static string $resource = WhatsappWebhookResource::class;

    public function infolist(Schema $infolist): Schema
    {
        return $infolist
            ->schema([
                Section::make(__('filament-evolution::webhook.sections.webhook_info'))
                    ->schema([
                        TextEntry::make('instance.name')
                            ->label(__('filament-evolution::webhook.fields.instance'))
                            ->placeholder('-'),

                        TextEntry::make('event')
                            ->label(__('filament-evolution::webhook.fields.event'))
                            ->badge(),

                        TextEntry::make('processed')
                            ->label(__('filament-evolution::webhook.fields.processed'))
                            ->badge()
                            ->formatStateUsing(fn ($state) => $state ? __('filament-evolution::webhook.status.yes') : __('filament-evolution::webhook.status.no'))
                            ->color(fn ($state) => $state ? 'success' : 'warning'),

                        TextEntry::make('processing_time_ms')
                            ->label(__('filament-evolution::webhook.fields.processing_time'))
                            ->suffix(' ms')
                            ->placeholder('-'),

                        TextEntry::make('created_at')
                            ->label(__('filament-evolution::webhook.fields.created_at'))
                            ->dateTime(),

                        TextEntry::make('updated_at')
                            ->label(__('filament-evolution::webhook.fields.updated_at'))
                            ->dateTime(),
                    ])
                    ->columns(3),

                Section::make(__('filament-evolution::webhook.sections.error'))
                    ->schema([
                        TextEntry::make('error')
                            ->label('')
                            ->columnSpanFull()
                            ->prose()
                            ->color('danger'),
                    ])
                    ->visible(fn ($record) => ! empty($record->error)),

                Section::make(__('filament-evolution::webhook.sections.payload'))
                    ->schema([
                        TextEntry::make('payload')
                            ->label('')
                            ->columnSpanFull()
                            ->formatStateUsing(fn ($state) => $state ? json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : '-')
                            ->prose(),
                    ])
                    ->collapsible(),
            ]);
    }
}
