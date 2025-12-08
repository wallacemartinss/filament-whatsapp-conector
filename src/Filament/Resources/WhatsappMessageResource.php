<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Filament\Resources;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use WallaceMartinss\FilamentEvolution\Enums\MessageDirectionEnum;
use WallaceMartinss\FilamentEvolution\Enums\MessageStatusEnum;
use WallaceMartinss\FilamentEvolution\Enums\MessageTypeEnum;
use WallaceMartinss\FilamentEvolution\Filament\Resources\WhatsappMessageResource\Pages;
use WallaceMartinss\FilamentEvolution\Models\WhatsappMessage;

class WhatsappMessageResource extends Resource
{
    protected static ?string $model = WhatsappMessage::class;

    public static function getNavigationSort(): ?int
    {
        return config('filament-evolution.filament.navigation_sort', 100) + 1;
    }

    public static function getNavigationIcon(): string|Heroicon|null
    {
        return Heroicon::ChatBubbleBottomCenterText;
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament-evolution::resource.navigation_group');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament-evolution::message.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament-evolution::message.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament-evolution::message.plural_model_label');
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
                    ->label(__('filament-evolution::message.fields.instance'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('direction')
                    ->label(__('filament-evolution::message.fields.direction'))
                    ->badge()
                    ->sortable(),

                TextColumn::make('phone')
                    ->label(__('filament-evolution::message.fields.phone'))
                    ->searchable()
                    ->copyable(),

                TextColumn::make('type')
                    ->label(__('filament-evolution::message.fields.type'))
                    ->badge()
                    ->sortable(),

                TextColumn::make('content.text')
                    ->label(__('filament-evolution::message.fields.content'))
                    ->limit(50)
                    ->tooltip(fn ($state) => $state)
                    ->searchable(query: function ($query, string $search) {
                        return $query->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(content, '$.text')) LIKE ?", ["%{$search}%"]);
                    }),

                TextColumn::make('status')
                    ->label(__('filament-evolution::message.fields.status'))
                    ->badge()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('filament-evolution::message.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('instance')
                    ->relationship('instance', 'name')
                    ->label(__('filament-evolution::message.fields.instance'))
                    ->preload(),

                SelectFilter::make('direction')
                    ->options(MessageDirectionEnum::class)
                    ->label(__('filament-evolution::message.fields.direction')),

                SelectFilter::make('type')
                    ->options(MessageTypeEnum::class)
                    ->label(__('filament-evolution::message.fields.type')),

                SelectFilter::make('status')
                    ->options(MessageStatusEnum::class)
                    ->label(__('filament-evolution::message.fields.status')),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWhatsappMessages::route('/'),
            'view' => Pages\ViewWhatsappMessage::route('/{record}'),
        ];
    }
}
