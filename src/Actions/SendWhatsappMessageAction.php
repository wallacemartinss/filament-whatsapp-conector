<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Actions;

use Filament\Actions\Action;
use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Grid;
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
            Grid::make(2)
                ->schema([
                    $this->getInstanceSelect(),
                    $this->getNumberInput(),
                ]),

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
        ];
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

            $instanceId = $data['instance_id'] ?? $this->defaultInstanceId;
            $number = $data['number'] ?? $this->defaultNumber;

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
}
