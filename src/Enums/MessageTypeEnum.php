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
    case BUTTONS = 'buttons';
    case LIST = 'list';
    case CTA = 'cta';
    case PIX = 'pix';
    case CAROUSEL = 'carousel';

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
            self::BUTTONS => __('filament-evolution::enums.message_type.buttons'),
            self::LIST => __('filament-evolution::enums.message_type.list'),
            self::CTA => __('filament-evolution::enums.message_type.cta'),
            self::PIX => __('filament-evolution::enums.message_type.pix'),
            self::CAROUSEL => __('filament-evolution::enums.message_type.carousel'),
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
            self::BUTTONS => 'info',
            self::LIST => 'info',
            self::CTA => 'primary',
            self::PIX => 'success',
            self::CAROUSEL => 'primary',
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
            self::BUTTONS => 'heroicon-o-cursor-arrow-rays',
            self::LIST => 'heroicon-o-list-bullet',
            self::CTA => 'heroicon-o-link',
            self::PIX => 'heroicon-o-banknotes',
            self::CAROUSEL => 'heroicon-o-rectangle-stack',
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

    public function isInteractive(): bool
    {
        return in_array($this, [
            self::BUTTONS,
            self::LIST,
            self::CTA,
            self::PIX,
            self::CAROUSEL,
        ], true);
    }
}
