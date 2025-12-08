<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Filament\Resources;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use WallaceMartinss\FilamentEvolution\Enums\WebhookEventEnum;
use WallaceMartinss\FilamentEvolution\Filament\Resources\WhatsappWebhookResource\Pages;
use WallaceMartinss\FilamentEvolution\Models\WhatsappWebhook;

class WhatsappWebhookResource extends Resource
{
    protected static ?string $model = WhatsappWebhook::class;

    public static function getNavigationSort(): ?int
    {
        return config('filament-evolution.filament.navigation_sort', 100) + 2;
    }

    public static function getNavigationIcon(): string|Heroicon|null
    {
        return Heroicon::QueueList;
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament-evolution::resource.navigation_group');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament-evolution::webhook.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament-evolution::webhook.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament-evolution::webhook.plural_model_label');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function form(Schema $form): Schema
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('instance.name')
                    ->label(__('filament-evolution::webhook.fields.instance'))
                    ->searchable()
                    ->sortable()
                    ->placeholder('-'),

                TextColumn::make('event')
                    ->label(__('filament-evolution::webhook.fields.event'))
                    ->badge()
                    ->alignCenter()
                    ->sortable(),

                IconColumn::make('processed')
                    ->label(__('filament-evolution::webhook.fields.processed'))
                    ->boolean()
                    ->alignCenter()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-clock')
                    ->trueColor('success')
                    ->falseColor('warning')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('filament-evolution::webhook.fields.created_at'))
                    ->alignCenter()
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('instance')
                    ->relationship('instance', 'name')
                    ->label(__('filament-evolution::webhook.fields.instance'))
                    ->preload(),

                SelectFilter::make('event')
                    ->options(WebhookEventEnum::class)
                    ->label(__('filament-evolution::webhook.fields.event')),

                TernaryFilter::make('processed')
                    ->label(__('filament-evolution::webhook.fields.processed')),

                TernaryFilter::make('has_error')
                    ->label(__('filament-evolution::webhook.fields.has_error'))
                    ->queries(
                        true: fn ($query) => $query->whereNotNull('error'),
                        false: fn ($query) => $query->whereNull('error'),
                    ),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWhatsappWebhooks::route('/'),
            'view' => Pages\ViewWhatsappWebhook::route('/{record}'),
        ];
    }
}
