<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum MessageTypeEnum: string implements HasColor, HasIcon, HasLabel
{
    case TEXT = 'text';
    case IMAGE = 'image';
    case AUDIO = 'audio';
    case VIDEO = 'video';
    case DOCUMENT = 'document';
    case LOCATION = 'location';
    case CONTACT = 'contact';
    case STICKER = 'sticker';

    public function getLabel(): string
    {
        return match ($this) {
            self::TEXT => __('filament-evolution::enums.message_type.text'),
            self::IMAGE => __('filament-evolution::enums.message_type.image'),
            self::AUDIO => __('filament-evolution::enums.message_type.audio'),
            self::VIDEO => __('filament-evolution::enums.message_type.video'),
            self::DOCUMENT => __('filament-evolution::enums.message_type.document'),
            self::LOCATION => __('filament-evolution::enums.message_type.location'),
            self::CONTACT => __('filament-evolution::enums.message_type.contact'),
            self::STICKER => __('filament-evolution::enums.message_type.sticker'),
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::TEXT => 'gray',
            self::IMAGE => 'success',
            self::AUDIO => 'warning',
            self::VIDEO => 'info',
            self::DOCUMENT => 'primary',
            self::LOCATION => 'danger',
            self::CONTACT => 'gray',
            self::STICKER => 'warning',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::TEXT => 'heroicon-o-chat-bubble-left',
            self::IMAGE => 'heroicon-o-photo',
            self::AUDIO => 'heroicon-o-microphone',
            self::VIDEO => 'heroicon-o-video-camera',
            self::DOCUMENT => 'heroicon-o-document',
            self::LOCATION => 'heroicon-o-map-pin',
            self::CONTACT => 'heroicon-o-user',
            self::STICKER => 'heroicon-o-face-smile',
        };
    }

    public function isMedia(): bool
    {
        return in_array($this, [self::IMAGE, self::AUDIO, self::VIDEO, self::DOCUMENT], true);
    }

    public function isText(): bool
    {
        return $this === self::TEXT;
    }
}
