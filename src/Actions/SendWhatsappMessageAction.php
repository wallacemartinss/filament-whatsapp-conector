<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Actions;

use Filament\Actions\Action;
use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Support\Icons\Heroicon;
use WallaceMartinss\FilamentEvolution\Enums\MessageTypeEnum;
use WallaceMartinss\FilamentEvolution\Enums\StatusConnectionEnum;
use WallaceMartinss\FilamentEvolution\Models\WhatsappInstance;
use WallaceMartinss\FilamentEvolution\Services\WhatsappService;

class SendWhatsappMessageAction extends Action
{
    use CanCustomizeProcess;

    protected ?string $defaultNumber = null;

    protected ?string $defaultInstanceId = null;

    protected ?string $defaultMessage = null;

    protected bool $showInstanceSelect = true;

    protected bool $showNumberInput = true;

    protected ?string $mediaDisk = null;

    protected array $allowedTypes = [];

    protected string|\Closure|null $numberAttribute = null;

    protected string|\Closure|null $instanceAttribute = null;

    public static function getDefaultName(): ?string
    {
        return 'send_whatsapp_message';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('filament-evolution::action.send_message'));

        $this->icon(Heroicon::ChatBubbleLeftRight);

        $this->color('success');

        $this->modalHeading(__('filament-evolution::action.modal_heading'));

        $this->modalDescription(__('filament-evolution::action.modal_description'));

        $this->modalIcon(Heroicon::ChatBubbleLeftRight);

        $this->modalSubmitActionLabel(__('filament-evolution::action.send'));

        $this->modalWidth('lg');

        $this->form(fn (): array => $this->getFormSchema());

        $this->action(function (array $data): void {
            $this->sendMessage($data);
        });
    }

    /**
     * Set the default phone number.
     */
    public function number(?string $number): static
    {
        $this->defaultNumber = $number;

        return $this;
    }

    /**
     * Set the default instance ID.
     */
    public function instance(?string $instanceId): static
    {
        $this->defaultInstanceId = $instanceId;

        return $this;
    }

    /**
     * Set the default message.
     */
    public function message(?string $message): static
    {
        $this->defaultMessage = $message;

        return $this;
    }

    /**
     * Hide the instance select field.
     */
    public function hideInstanceSelect(bool $hide = true): static
    {
        $this->showInstanceSelect = ! $hide;

        return $this;
    }

    /**
     * Hide the number input field.
     */
    public function hideNumberInput(bool $hide = true): static
    {
        $this->showNumberInput = ! $hide;

        return $this;
    }

    /**
     * Set the phone number from a record attribute.
     * Can be a string (attribute name) or a closure that receives the record.
     *
     * @param  string|\Closure  $attribute  The attribute name or a closure that receives the record
     *
     * Example usage:
     * - SendWhatsappMessageAction::make()->numberFrom('phone')
     * - SendWhatsappMessageAction::make()->numberFrom('contact.phone')
     * - SendWhatsappMessageAction::make()->numberFrom(fn ($record) => $record->phone)
     */
    public function numberFrom(string|\Closure $attribute): static
    {
        $this->numberAttribute = $attribute;

        return $this;
    }

    /**
     * Set the instance from a record attribute.
     * Can be a string (attribute name) or a closure that receives the record.
     */
    public function instanceFrom(string|\Closure $attribute): static
    {
        $this->instanceAttribute = $attribute;

        return $this;
    }

    /**
     * Get the phone number from the record.
     */
    protected function getNumberFromRecord(mixed $record): ?string
    {
        if ($this->numberAttribute === null) {
            return $this->defaultNumber;
        }

        if ($this->numberAttribute instanceof \Closure) {
            return ($this->numberAttribute)($record);
        }

        // Support dot notation for nested attributes
        return data_get($record, $this->numberAttribute);
    }

    /**
     * Get the instance ID from the record.
     */
    protected function getInstanceFromRecord(mixed $record): ?string
    {
        if ($this->instanceAttribute === null) {
            return $this->defaultInstanceId;
        }

        if ($this->instanceAttribute instanceof \Closure) {
            return ($this->instanceAttribute)($record);
        }

        return data_get($record, $this->instanceAttribute);
    }

    /**
     * Set the disk for media uploads.
     */
    public function disk(?string $disk): static
    {
        $this->mediaDisk = $disk;

        return $this;
    }

    /**
     * Limit the allowed message types.
     */
    public function allowedTypes(array $types): static
    {
        $this->allowedTypes = $types;

        return $this;
    }

    /**
     * Only allow text messages.
     */
    public function textOnly(): static
    {
        return $this->allowedTypes([MessageTypeEnum::TEXT]);
    }

    /**
     * Get the form schema.
     */
    protected function getFormSchema(): array
    {
        return [
            $this->getInstanceSelect(),
            $this->getNumberInput(),

            $this->getTypeSelect(),

            $this->getMessageInput(),

            $this->getCaptionInput(),

            $this->getMediaUpload(),

            Grid::make(2)
                ->schema([
                    $this->getLatitudeInput(),
                    $this->getLongitudeInput(),
                ])
                ->visible(fn (Get $get): bool => $get('type') === MessageTypeEnum::LOCATION->value),

            Grid::make(2)
                ->schema([
                    $this->getLocationNameInput(),
                    $this->getLocationAddressInput(),
                ])
                ->visible(fn (Get $get): bool => $get('type') === MessageTypeEnum::LOCATION->value),

            Grid::make(2)
                ->schema([
                    $this->getContactNameInput(),
                    $this->getContactNumberInput(),
                ])
                ->visible(fn (Get $get): bool => $get('type') === MessageTypeEnum::CONTACT->value),

            // Interactive: Buttons / CTA / PIX share description+title+footer
            Section::make(__('filament-evolution::action.interactive_section'))
                ->schema([
                    $this->getInteractiveDescriptionInput(),
                    Grid::make(2)->schema([
                        $this->getInteractiveTitleInput(),
                        $this->getInteractiveFooterInput(),
                    ]),
                ])
                ->visible(fn (Get $get): bool => in_array($get('type'), [
                    MessageTypeEnum::BUTTONS->value,
                    MessageTypeEnum::CTA->value,
                    MessageTypeEnum::PIX->value,
                ], true))
                ->columnSpanFull(),

            $this->getReplyButtonsRepeater(),
            $this->getCtaButtonsRepeater(),

            // PIX (single payment button)
            Section::make(__('filament-evolution::action.pix_section'))
                ->schema([
                    Grid::make(2)->schema([
                        Select::make('pix_key_type')
                            ->label(__('filament-evolution::action.pix_key_type'))
                            ->options([
                                'phone' => 'Telefone',
                                'email' => 'Email',
                                'cpf' => 'CPF',
                                'cnpj' => 'CNPJ',
                                'random' => __('filament-evolution::action.pix_key_random'),
                            ])
                            ->default('phone')
                            ->required(fn (Get $get): bool => $get('type') === MessageTypeEnum::PIX->value),
                        TextInput::make('pix_key')
                            ->label(__('filament-evolution::action.pix_key'))
                            ->required(fn (Get $get): bool => $get('type') === MessageTypeEnum::PIX->value),
                    ]),
                    Grid::make(2)->schema([
                        TextInput::make('pix_name')
                            ->label(__('filament-evolution::action.pix_name'))
                            ->required(fn (Get $get): bool => $get('type') === MessageTypeEnum::PIX->value),
                        TextInput::make('pix_currency')
                            ->label(__('filament-evolution::action.pix_currency'))
                            ->default('BRL'),
                    ]),
                    TextInput::make('pix_amount')
                        ->label(__('filament-evolution::action.pix_amount'))
                        ->helperText(__('filament-evolution::action.pix_amount_helper'))
                        ->numeric()
                        ->minValue(0)
                        ->step(0.01)
                        ->placeholder('100.50'),
                ])
                ->visible(fn (Get $get): bool => $get('type') === MessageTypeEnum::PIX->value)
                ->columnSpanFull(),

            // List
            Section::make(__('filament-evolution::action.list_section'))
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('list_title')
                            ->label(__('filament-evolution::action.list_title'))
                            ->required(fn (Get $get): bool => $get('type') === MessageTypeEnum::LIST->value),
                        TextInput::make('list_button_text')
                            ->label(__('filament-evolution::action.list_button_text'))
                            ->required(fn (Get $get): bool => $get('type') === MessageTypeEnum::LIST->value)
                            ->placeholder(__('filament-evolution::action.list_button_text_placeholder')),
                    ]),
                    Textarea::make('list_description')
                        ->label(__('filament-evolution::action.list_description'))
                        ->required(fn (Get $get): bool => $get('type') === MessageTypeEnum::LIST->value)
                        ->rows(2),
                    TextInput::make('list_footer')
                        ->label(__('filament-evolution::action.list_footer')),
                    Repeater::make('list_sections')
                        ->label(__('filament-evolution::action.list_sections'))
                        ->schema([
                            TextInput::make('title')
                                ->label(__('filament-evolution::action.list_section_title'))
                                ->required(),
                            Repeater::make('rows')
                                ->label(__('filament-evolution::action.list_section_rows'))
                                ->schema([
                                    Grid::make(2)->schema([
                                        TextInput::make('title')
                                            ->label(__('filament-evolution::action.list_row_title'))
                                            ->required(),
                                        TextInput::make('rowId')
                                            ->label(__('filament-evolution::action.list_row_id'))
                                            ->required(),
                                    ]),
                                    TextInput::make('description')
                                        ->label(__('filament-evolution::action.list_row_description')),
                                ])
                                ->minItems(1)
                                ->defaultItems(1)
                                ->reorderable(),
                        ])
                        ->minItems(1)
                        ->defaultItems(1)
                        ->required(fn (Get $get): bool => $get('type') === MessageTypeEnum::LIST->value),
                ])
                ->visible(fn (Get $get): bool => $get('type') === MessageTypeEnum::LIST->value)
                ->columnSpanFull(),

            // Carousel
            Section::make(__('filament-evolution::action.carousel_section'))
                ->schema([
                    Textarea::make('carousel_message')
                        ->label(__('filament-evolution::action.carousel_message'))
                        ->required(fn (Get $get): bool => $get('type') === MessageTypeEnum::CAROUSEL->value)
                        ->rows(2),
                    Repeater::make('carousel_cards')
                        ->label(__('filament-evolution::action.carousel_cards'))
                        ->schema([
                            TextInput::make('imageUrl')
                                ->label(__('filament-evolution::action.carousel_image_url'))
                                ->url()
                                ->helperText(__('filament-evolution::action.carousel_image_helper')),
                            Grid::make(2)->schema([
                                TextInput::make('header')
                                    ->label(__('filament-evolution::action.carousel_header')),
                                TextInput::make('footer')
                                    ->label(__('filament-evolution::action.carousel_footer')),
                            ]),
                            Textarea::make('body')
                                ->label(__('filament-evolution::action.carousel_body'))
                                ->rows(2),
                            Repeater::make('buttons')
                                ->label(__('filament-evolution::action.carousel_buttons'))
                                ->schema([
                                    Grid::make(3)->schema([
                                        Select::make('type')
                                            ->label(__('filament-evolution::action.button_type'))
                                            ->options([
                                                'reply' => __('filament-evolution::action.button_type_reply'),
                                                'url' => __('filament-evolution::action.button_type_url'),
                                                'call' => __('filament-evolution::action.button_type_call'),
                                                'copy' => __('filament-evolution::action.button_type_copy'),
                                            ])
                                            ->default('reply')
                                            ->required()
                                            ->live(),
                                        TextInput::make('displayText')
                                            ->label(__('filament-evolution::action.button_text'))
                                            ->required(),
                                        TextInput::make('value')
                                            ->label(__('filament-evolution::action.button_value'))
                                            ->helperText(__('filament-evolution::action.button_value_helper')),
                                    ]),
                                ])
                                ->defaultItems(0)
                                ->reorderable(),
                        ])
                        ->minItems(1)
                        ->defaultItems(1)
                        ->reorderable()
                        ->required(fn (Get $get): bool => $get('type') === MessageTypeEnum::CAROUSEL->value),
                ])
                ->visible(fn (Get $get): bool => $get('type') === MessageTypeEnum::CAROUSEL->value)
                ->columnSpanFull(),
        ];
    }

    protected function getInteractiveDescriptionInput(): Textarea
    {
        return Textarea::make('interactive_description')
            ->label(__('filament-evolution::action.interactive_description'))
            ->required(fn (Get $get): bool => in_array($get('type'), [
                MessageTypeEnum::BUTTONS->value,
                MessageTypeEnum::CTA->value,
                MessageTypeEnum::PIX->value,
            ], true))
            ->rows(3)
            ->columnSpanFull();
    }

    protected function getInteractiveTitleInput(): TextInput
    {
        return TextInput::make('interactive_title')
            ->label(__('filament-evolution::action.interactive_title'));
    }

    protected function getInteractiveFooterInput(): TextInput
    {
        return TextInput::make('interactive_footer')
            ->label(__('filament-evolution::action.interactive_footer'));
    }

    protected function getReplyButtonsRepeater(): Repeater
    {
        return Repeater::make('reply_buttons')
            ->label(__('filament-evolution::action.reply_buttons'))
            ->schema([
                Grid::make(2)->schema([
                    TextInput::make('displayText')
                        ->label(__('filament-evolution::action.button_text'))
                        ->required(),
                    TextInput::make('id')
                        ->label(__('filament-evolution::action.button_id'))
                        ->required(),
                ]),
            ])
            ->minItems(1)
            ->maxItems(3)
            ->defaultItems(1)
            ->reorderable()
            ->columnSpanFull()
            ->visible(fn (Get $get): bool => $get('type') === MessageTypeEnum::BUTTONS->value);
    }

    protected function getCtaButtonsRepeater(): Repeater
    {
        return Repeater::make('cta_buttons')
            ->label(__('filament-evolution::action.cta_buttons'))
            ->helperText(__('filament-evolution::action.cta_buttons_helper'))
            ->schema([
                Grid::make(3)->schema([
                    Select::make('type')
                        ->label(__('filament-evolution::action.button_type'))
                        ->options([
                            'url' => __('filament-evolution::action.button_type_url'),
                            'call' => __('filament-evolution::action.button_type_call'),
                            'copy' => __('filament-evolution::action.button_type_copy'),
                        ])
                        ->default('url')
                        ->required(),
                    TextInput::make('displayText')
                        ->label(__('filament-evolution::action.button_text'))
                        ->required(),
                    TextInput::make('value')
                        ->label(__('filament-evolution::action.button_value'))
                        ->helperText(__('filament-evolution::action.button_value_helper'))
                        ->required(),
                ]),
            ])
            ->minItems(1)
            ->maxItems(2)
            ->defaultItems(1)
            ->reorderable()
            ->columnSpanFull()
            ->visible(fn (Get $get): bool => $get('type') === MessageTypeEnum::CTA->value);
    }

    protected function getInstanceSelect(): Select
    {
        $action = $this;

        return Select::make('instance_id')
            ->label(__('filament-evolution::action.instance'))
            ->options(function (): array {
                return WhatsappInstance::where('status', StatusConnectionEnum::OPEN)
                    ->pluck('name', 'id')
                    ->toArray();
            })
            ->default(function () use ($action): ?string {
                $record = $action->getRecord();
                if ($record && $action->instanceAttribute) {
                    return $action->getInstanceFromRecord($record);
                }

                if ($action->defaultInstanceId) {
                    return $action->defaultInstanceId;
                }

                $first = WhatsappInstance::where('status', StatusConnectionEnum::OPEN)->first();

                return $first?->id;
            })
            ->required()
            ->searchable()
            ->preload()
            ->visible($this->showInstanceSelect)
            ->columnSpanFull()
            ->helperText(__('filament-evolution::action.instance_helper'));
    }

    protected function getNumberInput(): TextInput
    {
        $action = $this;

        return TextInput::make('number')
            ->label(__('filament-evolution::action.number'))
            ->default(function () use ($action): ?string {
                $record = $action->getRecord();
                if ($record && $action->numberAttribute) {
                    return $action->getNumberFromRecord($record);
                }

                return $action->defaultNumber;
            })
            ->required()
            ->tel()
            ->placeholder('5511999999999')
            ->visible($this->showNumberInput)
            ->columnSpanFull()
            ->helperText(__('filament-evolution::action.number_helper'));
    }

    protected function getTypeSelect(): Select
    {
        $options = $this->getAllowedTypeOptions();

        return Select::make('type')
            ->label(__('filament-evolution::action.type'))
            ->options($options)
            ->default(MessageTypeEnum::TEXT->value)
            ->required()
            ->live()
            ->visible(count($options) > 1);
    }

    protected function getAllowedTypeOptions(): array
    {
        $allTypes = [
            MessageTypeEnum::TEXT,
            MessageTypeEnum::IMAGE,
            MessageTypeEnum::VIDEO,
            MessageTypeEnum::AUDIO,
            MessageTypeEnum::DOCUMENT,
            MessageTypeEnum::LOCATION,
            MessageTypeEnum::CONTACT,
            MessageTypeEnum::BUTTONS,
            MessageTypeEnum::LIST,
            MessageTypeEnum::CTA,
            MessageTypeEnum::PIX,
            MessageTypeEnum::CAROUSEL,
        ];

        $types = ! empty($this->allowedTypes) ? $this->allowedTypes : $allTypes;

        return collect($types)
            ->mapWithKeys(fn (MessageTypeEnum $type) => [$type->value => $type->getLabel()])
            ->toArray();
    }

    protected function getMessageInput(): Textarea
    {
        return Textarea::make('message')
            ->label(__('filament-evolution::action.message'))
            ->default($this->defaultMessage)
            ->required(fn (Get $get): bool => $get('type') === MessageTypeEnum::TEXT->value)
            ->visible(fn (Get $get): bool => $get('type') === MessageTypeEnum::TEXT->value)
            ->rows(4)
            ->placeholder(__('filament-evolution::action.message_placeholder'));
    }

    protected function getCaptionInput(): Textarea
    {
        return Textarea::make('caption')
            ->label(__('filament-evolution::action.caption'))
            ->visible(fn (Get $get): bool => in_array($get('type'), [
                MessageTypeEnum::IMAGE->value,
                MessageTypeEnum::VIDEO->value,
                MessageTypeEnum::DOCUMENT->value,
            ]))
            ->rows(2)
            ->placeholder(__('filament-evolution::action.caption_placeholder'));
    }

    protected function getMediaUpload(): FileUpload
    {
        return FileUpload::make('media')
            ->label(__('filament-evolution::action.media'))
            ->required(fn (Get $get): bool => in_array($get('type'), [
                MessageTypeEnum::IMAGE->value,
                MessageTypeEnum::VIDEO->value,
                MessageTypeEnum::AUDIO->value,
                MessageTypeEnum::DOCUMENT->value,
            ]))
            ->visible(fn (Get $get): bool => in_array($get('type'), [
                MessageTypeEnum::IMAGE->value,
                MessageTypeEnum::VIDEO->value,
                MessageTypeEnum::AUDIO->value,
                MessageTypeEnum::DOCUMENT->value,
            ]))
            ->disk($this->mediaDisk ?? config('filament-evolution.media.disk', 'public'))
            ->directory(config('filament-evolution.media.directory', 'whatsapp-media'))
            ->acceptedFileTypes(fn (Get $get): array => $this->getAcceptedFileTypes($get('type')))
            ->maxSize(config('filament-evolution.media.max_size', 16384))
            ->helperText(__('filament-evolution::action.media_helper'));
    }

    protected function getAcceptedFileTypes(?string $type): array
    {
        return match ($type) {
            MessageTypeEnum::IMAGE->value => ['image/jpeg', 'image/png', 'image/gif', 'image/webp'],
            MessageTypeEnum::VIDEO->value => ['video/mp4', 'video/3gpp', 'video/quicktime'],
            MessageTypeEnum::AUDIO->value => ['audio/mpeg', 'audio/ogg', 'audio/wav', 'audio/aac', 'audio/mp4'],
            MessageTypeEnum::DOCUMENT->value => [
                'application/pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'text/plain',
                'text/csv',
            ],
            default => [],
        };
    }

    protected function getLatitudeInput(): TextInput
    {
        return TextInput::make('latitude')
            ->label(__('filament-evolution::action.latitude'))
            ->required(fn (Get $get): bool => $get('type') === MessageTypeEnum::LOCATION->value)
            ->numeric()
            ->step(0.000001)
            ->placeholder('-23.5505');
    }

    protected function getLongitudeInput(): TextInput
    {
        return TextInput::make('longitude')
            ->label(__('filament-evolution::action.longitude'))
            ->required(fn (Get $get): bool => $get('type') === MessageTypeEnum::LOCATION->value)
            ->numeric()
            ->step(0.000001)
            ->placeholder('-46.6333');
    }

    protected function getLocationNameInput(): TextInput
    {
        return TextInput::make('location_name')
            ->label(__('filament-evolution::action.location_name'))
            ->placeholder(__('filament-evolution::action.location_name_placeholder'));
    }

    protected function getLocationAddressInput(): TextInput
    {
        return TextInput::make('location_address')
            ->label(__('filament-evolution::action.location_address'))
            ->placeholder(__('filament-evolution::action.location_address_placeholder'));
    }

    protected function getContactNameInput(): TextInput
    {
        return TextInput::make('contact_name')
            ->label(__('filament-evolution::action.contact_name'))
            ->required(fn (Get $get): bool => $get('type') === MessageTypeEnum::CONTACT->value)
            ->placeholder('John Doe');
    }

    protected function getContactNumberInput(): TextInput
    {
        return TextInput::make('contact_number')
            ->label(__('filament-evolution::action.contact_number'))
            ->required(fn (Get $get): bool => $get('type') === MessageTypeEnum::CONTACT->value)
            ->tel()
            ->placeholder('5511999999999');
    }

    protected function sendMessage(array $data): void
    {
        try {
            $service = app(WhatsappService::class);
            $type = MessageTypeEnum::from($data['type'] ?? MessageTypeEnum::TEXT->value);

            // Get instance ID from form, record attribute, or default
            $instanceId = $data['instance_id'] ?? null;
            if (! $instanceId && $this->instanceAttribute) {
                $record = $this->getRecord();
                if ($record) {
                    $instanceId = $this->getInstanceFromRecord($record);
                }
            }
            $instanceId = $instanceId ?? $this->defaultInstanceId;

            // Get number from form, record attribute, or default
            $number = $data['number'] ?? null;
            if (! $number && $this->numberAttribute) {
                $record = $this->getRecord();
                if ($record) {
                    $number = $this->getNumberFromRecord($record);
                }
            }
            $number = $number ?? $this->defaultNumber;

            if (! $instanceId || ! $number) {
                throw new \Exception(__('filament-evolution::action.missing_required_fields'));
            }

            // FileUpload returns an array, get the first file path
            $mediaPath = null;
            if (isset($data['media'])) {
                $mediaPath = is_array($data['media']) ? ($data['media'][0] ?? null) : $data['media'];
            }

            $result = match ($type) {
                MessageTypeEnum::TEXT => $service->sendText($instanceId, $number, $data['message']),
                MessageTypeEnum::IMAGE => $service->sendImage(
                    $instanceId,
                    $number,
                    $mediaPath,
                    $data['caption'] ?? null
                ),
                MessageTypeEnum::VIDEO => $service->sendVideo(
                    $instanceId,
                    $number,
                    $mediaPath,
                    $data['caption'] ?? null
                ),
                MessageTypeEnum::AUDIO => $service->sendAudio($instanceId, $number, $mediaPath),
                MessageTypeEnum::DOCUMENT => $service->sendDocument(
                    $instanceId,
                    $number,
                    $mediaPath,
                    null,
                    $data['caption'] ?? null
                ),
                MessageTypeEnum::LOCATION => $service->sendLocation(
                    $instanceId,
                    $number,
                    (float) $data['latitude'],
                    (float) $data['longitude'],
                    $data['location_name'] ?? null,
                    $data['location_address'] ?? null
                ),
                MessageTypeEnum::CONTACT => $service->sendContact(
                    $instanceId,
                    $number,
                    $data['contact_name'],
                    $data['contact_number']
                ),
                MessageTypeEnum::BUTTONS => $service->sendButtons(
                    $instanceId,
                    $number,
                    $data['interactive_description'] ?? '',
                    $this->buildReplyButtons($data['reply_buttons'] ?? []),
                    $data['interactive_title'] ?? null,
                    $data['interactive_footer'] ?? null,
                ),
                MessageTypeEnum::CTA => $service->sendCta(
                    $instanceId,
                    $number,
                    $data['interactive_description'] ?? '',
                    $this->buildCtaButtons($data['cta_buttons'] ?? []),
                    $data['interactive_title'] ?? null,
                    $data['interactive_footer'] ?? null,
                ),
                MessageTypeEnum::PIX => $service->sendPix(
                    $instanceId,
                    $number,
                    $data['interactive_description'] ?? '',
                    array_filter([
                        'currency' => $data['pix_currency'] ?? 'BRL',
                        'name' => $data['pix_name'] ?? '',
                        'keyType' => $data['pix_key_type'] ?? 'phone',
                        'key' => $data['pix_key'] ?? '',
                        'amount' => isset($data['pix_amount']) && $data['pix_amount'] !== ''
                            ? (float) $data['pix_amount']
                            : null,
                    ], fn ($value) => $value !== null && $value !== ''),
                    $data['interactive_title'] ?? null,
                    $data['interactive_footer'] ?? null,
                ),
                MessageTypeEnum::LIST => $service->sendList(
                    $instanceId,
                    $number,
                    $data['list_title'] ?? '',
                    $data['list_description'] ?? '',
                    $data['list_button_text'] ?? '',
                    $this->buildListSections($data['list_sections'] ?? []),
                    $data['list_footer'] ?? null,
                ),
                MessageTypeEnum::CAROUSEL => $service->sendCarousel(
                    $instanceId,
                    $number,
                    $data['carousel_message'] ?? '',
                    $this->buildCarouselCards($data['carousel_cards'] ?? []),
                ),
                default => throw new \Exception(__('filament-evolution::action.unsupported_type')),
            };

            Notification::make()
                ->title(__('filament-evolution::action.success_title'))
                ->body(__('filament-evolution::action.success_body'))
                ->success()
                ->send();
        } catch (\Exception $e) {
            Notification::make()
                ->title(__('filament-evolution::action.error_title'))
                ->body($e->getMessage())
                ->danger()
                ->send();

            throw $e;
        }
    }

    /**
     * Normalize reply-button repeater rows for Evolution API.
     */
    protected function buildReplyButtons(array $rows): array
    {
        return array_values(array_map(
            fn (array $row): array => [
                'type' => 'reply',
                'displayText' => $row['displayText'] ?? '',
                'id' => $row['id'] ?? '',
            ],
            array_filter($rows, fn ($row) => is_array($row)),
        ));
    }

    /**
     * Normalize CTA-button repeater rows for Evolution API.
     * Each row stores its target in a generic `value` field; we route it to the
     * type-specific key the API expects (url / phoneNumber / copyCode).
     */
    protected function buildCtaButtons(array $rows): array
    {
        $valueKey = [
            'url' => 'url',
            'call' => 'phoneNumber',
            'copy' => 'copyCode',
        ];

        return array_values(array_map(function (array $row) use ($valueKey): array {
            $type = $row['type'] ?? 'url';

            return [
                'type' => $type,
                'displayText' => $row['displayText'] ?? '',
                $valueKey[$type] ?? 'url' => $row['value'] ?? '',
            ];
        }, array_filter($rows, fn ($row) => is_array($row))));
    }

    /**
     * Normalize list sections repeater rows for Evolution API.
     */
    protected function buildListSections(array $rows): array
    {
        return array_values(array_map(
            fn (array $row): array => [
                'title' => $row['title'] ?? '',
                'rows' => array_values(array_map(
                    fn (array $innerRow): array => array_filter([
                        'title' => $innerRow['title'] ?? '',
                        'description' => $innerRow['description'] ?? null,
                        'rowId' => $innerRow['rowId'] ?? '',
                    ], fn ($value) => $value !== null && $value !== ''),
                    array_filter($row['rows'] ?? [], fn ($r) => is_array($r)),
                )),
            ],
            array_filter($rows, fn ($row) => is_array($row)),
        ));
    }

    /**
     * Normalize carousel card repeater rows for Evolution API.
     */
    protected function buildCarouselCards(array $rows): array
    {
        $ctaValueKey = [
            'url' => 'url',
            'call' => 'phoneNumber',
            'copy' => 'copyCode',
        ];

        return array_values(array_map(function (array $row) use ($ctaValueKey): array {
            $buttons = array_values(array_map(function (array $button) use ($ctaValueKey): array {
                $type = $button['type'] ?? 'reply';

                if ($type === 'reply') {
                    return [
                        'type' => 'reply',
                        'displayText' => $button['displayText'] ?? '',
                        'id' => $button['value'] ?? '',
                    ];
                }

                return [
                    'type' => $type,
                    'displayText' => $button['displayText'] ?? '',
                    $ctaValueKey[$type] ?? 'url' => $button['value'] ?? '',
                ];
            }, array_filter($row['buttons'] ?? [], fn ($b) => is_array($b))));

            return array_filter([
                'imageUrl' => $row['imageUrl'] ?? null,
                'header' => $row['header'] ?? null,
                'body' => $row['body'] ?? null,
                'footer' => $row['footer'] ?? null,
                'buttons' => $buttons,
            ], fn ($value) => $value !== null && $value !== '' && $value !== []);
        }, array_filter($rows, fn ($row) => is_array($row))));
    }
}
