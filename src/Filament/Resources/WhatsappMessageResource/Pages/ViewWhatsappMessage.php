<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Filament\Resources\WhatsappMessageResource\Pages;

use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use WallaceMartinss\FilamentEvolution\Filament\Resources\WhatsappMessageResource;

class ViewWhatsappMessage extends ViewRecord
{
    protected static string $resource = WhatsappMessageResource::class;

    public function infolist(Schema $infolist): Schema
    {
        return $infolist
            ->schema([
                Section::make(__('filament-evolution::message.sections.message_info'))
                    ->schema([
                        TextEntry::make('instance.name')
                            ->label(__('filament-evolution::message.fields.instance')),

                        TextEntry::make('direction')
                            ->label(__('filament-evolution::message.fields.direction'))
                            ->badge(),

                        TextEntry::make('phone')
                            ->label(__('filament-evolution::message.fields.phone'))
                            ->copyable(),

                        TextEntry::make('type')
                            ->label(__('filament-evolution::message.fields.type'))
                            ->badge(),

                        TextEntry::make('status')
                            ->label(__('filament-evolution::message.fields.status'))
                            ->badge(),

                        TextEntry::make('message_id')
                            ->label(__('filament-evolution::message.fields.message_id'))
                            ->copyable(),
                    ])
                    ->columns(3),

                Section::make(__('filament-evolution::message.sections.content'))
                    ->schema([
                        TextEntry::make('content')
                            ->label(__('filament-evolution::message.fields.content'))
                            ->columnSpanFull()
                            ->prose(),

                        TextEntry::make('media')
                            ->label(__('filament-evolution::message.fields.media'))
                            ->columnSpanFull()
                            ->formatStateUsing(fn ($state) => $state ? json_encode($state, JSON_PRETTY_PRINT) : '-')
                            ->visible(fn ($record) => ! empty($record->media)),
                    ]),

                Section::make(__('filament-evolution::message.sections.timestamps'))
                    ->schema([
                        TextEntry::make('sent_at')
                            ->label(__('filament-evolution::message.fields.sent_at'))
                            ->dateTime(),

                        TextEntry::make('delivered_at')
                            ->label(__('filament-evolution::message.fields.delivered_at'))
                            ->dateTime(),

                        TextEntry::make('read_at')
                            ->label(__('filament-evolution::message.fields.read_at'))
                            ->dateTime(),

                        TextEntry::make('created_at')
                            ->label(__('filament-evolution::message.fields.created_at'))
                            ->dateTime(),
                    ])
                    ->columns(4),

                Section::make(__('filament-evolution::message.sections.raw_payload'))
                    ->schema([
                        TextEntry::make('raw_payload')
                            ->label('')
                            ->columnSpanFull()
                            ->formatStateUsing(fn ($state) => $state ? json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : '-')
                            ->prose(),
                    ])
                    ->collapsible()
                    ->collapsed(),
            ]);
    }
}
