<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum MessageDirectionEnum: string implements HasColor, HasIcon, HasLabel
{
    case INCOMING = 'incoming';
    case OUTGOING = 'outgoing';

    public function getLabel(): string
    {
        return match ($this) {
            self::INCOMING => __('filament-evolution::enums.message_direction.incoming'),
            self::OUTGOING => __('filament-evolution::enums.message_direction.outgoing'),
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::INCOMING => 'info',
            self::OUTGOING => 'success',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::INCOMING => 'heroicon-o-arrow-down-left',
            self::OUTGOING => 'heroicon-o-arrow-up-right',
        };
    }

    public function isIncoming(): bool
    {
        return $this === self::INCOMING;
    }

    public function isOutgoing(): bool
    {
        return $this === self::OUTGOING;
    }
}
