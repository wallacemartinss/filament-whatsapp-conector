<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Filament\Resources;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use WallaceMartinss\FilamentEvolution\Enums\StatusConnectionEnum;
use WallaceMartinss\FilamentEvolution\Filament\Resources\WhatsappInstanceResource\Pages;
use WallaceMartinss\FilamentEvolution\Models\WhatsappInstance;

class WhatsappInstanceResource extends Resource
{
    protected static ?string $model = WhatsappInstance::class;

    public static function getNavigationSort(): ?int
    {
        return config('filament-evolution.filament.navigation_sort', 100);
    }

    public static function getNavigationIcon(): string|Heroicon|null
    {
        return Heroicon::ChatBubbleLeftRight;
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament-evolution::resource.navigation_group');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament-evolution::resource.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament-evolution::resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament-evolution::resource.plural_model_label');
    }

    public static function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Tabs::make('Instance')
                    ->tabs([
                        Tabs\Tab::make(__('filament-evolution::resource.sections.instance_info'))
                            ->icon(Heroicon::InformationCircle)
                            ->schema([
                                Section::make()
                                    ->schema([
                                        TextInput::make('name')
                                            ->label(__('filament-evolution::resource.fields.name'))
                                            ->helperText(__('filament-evolution::resource.fields.name_helper'))
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(ignoreRecord: true)
                                            ->columnSpan(1),

                                        TextInput::make('number')
                                            ->label(__('filament-evolution::resource.fields.number'))
                                            ->helperText(__('filament-evolution::resource.fields.number_helper'))
                                            ->required()
                                            ->tel()
                                            ->maxLength(20)
                                            ->columnSpan(1),
                                    ])
                                    ->columns(2),
                            ]),

                        Tabs\Tab::make(__('filament-evolution::resource.sections.settings'))
                            ->icon(Heroicon::Cog6Tooth)
                            ->schema([
                                Section::make()
                                    ->schema([
                                        ToggleButtons::make('reject_call')
                                            ->label(__('filament-evolution::resource.fields.reject_call'))
                                            ->helperText(__('filament-evolution::resource.fields.reject_call_helper'))
                                            ->default(config('filament-evolution.instance.reject_call', false))
                                            ->boolean()
                                            ->live()
                                            ->inline(),

                                        ToggleButtons::make('groups_ignore')
                                            ->label(__('filament-evolution::resource.fields.groups_ignore'))
                                            ->helperText(__('filament-evolution::resource.fields.groups_ignore_helper'))
                                            ->default(config('filament-evolution.instance.groups_ignore', false))
                                            ->boolean()
                                            ->inline(),

                                        ToggleButtons::make('always_online')
                                            ->label(__('filament-evolution::resource.fields.always_online'))
                                            ->helperText(__('filament-evolution::resource.fields.always_online_helper'))
                                            ->default(config('filament-evolution.instance.always_online', false))
                                            ->boolean()
                                            ->inline(),

                                        ToggleButtons::make('read_messages')
                                            ->label(__('filament-evolution::resource.fields.read_messages'))
                                            ->helperText(__('filament-evolution::resource.fields.read_messages_helper'))
                                            ->default(config('filament-evolution.instance.read_messages', false))
                                            ->boolean()
                                            ->inline(),

                                        ToggleButtons::make('read_status')
                                            ->label(__('filament-evolution::resource.fields.read_status'))
                                            ->helperText(__('filament-evolution::resource.fields.read_status_helper'))
                                            ->default(config('filament-evolution.instance.read_status', false))
                                            ->boolean()
                                            ->inline(),

                                        ToggleButtons::make('sync_full_history')
                                            ->label(__('filament-evolution::resource.fields.sync_full_history'))
                                            ->helperText(__('filament-evolution::resource.fields.sync_full_history_helper'))
                                            ->default(config('filament-evolution.instance.sync_full_history', false))
                                            ->boolean()
                                            ->inline(),

                                        TextInput::make('msg_call')
                                            ->label(__('filament-evolution::resource.fields.msg_call'))
                                            ->helperText(__('filament-evolution::resource.fields.msg_call_helper'))
                                            ->hidden(fn ($get) => $get('reject_call') == false)
                                            ->maxLength(255)
                                            ->default(config('filament-evolution.instance.msg_call', ''))
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(3),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('profile_picture_url')
                    ->label('')
                    ->alignCenter()
                    ->circular()
                    ->defaultImageUrl(fn () => 'https://ui-avatars.com/api/?name=WA&color=7F9CF5&background=EBF4FF'),

                TextColumn::make('name')
                    ->label(__('filament-evolution::resource.fields.name'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('number')
                    ->label(__('filament-evolution::resource.fields.number'))
                    ->alignCenter()
                    ->searchable(),

                TextColumn::make('status')
                    ->label(__('filament-evolution::resource.fields.status'))
                    ->badge()
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('filament-evolution::resource.fields.created_at'))
                    ->alignCenter()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label(__('filament-evolution::resource.fields.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(StatusConnectionEnum::class),
            ])
            ->recordActions([
                Action::make('connect')
                    ->label(__('filament-evolution::resource.actions.connect'))
                    ->icon(Heroicon::QrCode)
                    ->color('success')
                    ->action(fn ($record, $livewire) => $livewire->openConnectModal((string) $record->id))
                    ->hidden(fn ($record): bool => $record->status === StatusConnectionEnum::OPEN),
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWhatsappInstances::route('/'),
            'create' => Pages\CreateWhatsappInstance::route('/create'),
            'view' => Pages\ViewWhatsappInstance::route('/{record}'),
            'edit' => Pages\EditWhatsappInstance::route('/{record}/edit'),
        ];
    }
}
