<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum StatusConnectionEnum: string implements HasColor, HasIcon, HasLabel
{
    case CLOSE = 'close';
    case OPEN = 'open';
    case CONNECTING = 'connecting';
    case REFUSED = 'refused';

    public function getLabel(): string
    {
        return match ($this) {
            self::OPEN => __('filament-evolution::enums.status_connection.open'),
            self::CONNECTING => __('filament-evolution::enums.status_connection.connecting'),
            self::CLOSE => __('filament-evolution::enums.status_connection.close'),
            self::REFUSED => __('filament-evolution::enums.status_connection.refused'),
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::OPEN => 'success',
            self::CONNECTING => 'warning',
            self::CLOSE => 'danger',
            self::REFUSED => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::OPEN => 'heroicon-o-check-circle',
            self::CONNECTING => 'heroicon-o-arrow-path',
            self::CLOSE => 'heroicon-o-x-circle',
            self::REFUSED => 'heroicon-o-no-symbol',
        };
    }

    public function isConnected(): bool
    {
        return $this === self::OPEN;
    }

    public function isDisconnected(): bool
    {
        return in_array($this, [self::CLOSE, self::REFUSED], true);
    }

    public function isConnecting(): bool
    {
        return $this === self::CONNECTING;
    }
}
