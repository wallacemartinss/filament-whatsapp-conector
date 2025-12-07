<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum MessageStatusEnum: string implements HasColor, HasIcon, HasLabel
{
    case PENDING = 'pending';
    case SENT = 'sent';
    case DELIVERED = 'delivered';
    case READ = 'read';
    case FAILED = 'failed';

    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => __('filament-evolution::enums.message_status.pending'),
            self::SENT => __('filament-evolution::enums.message_status.sent'),
            self::DELIVERED => __('filament-evolution::enums.message_status.delivered'),
            self::READ => __('filament-evolution::enums.message_status.read'),
            self::FAILED => __('filament-evolution::enums.message_status.failed'),
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::PENDING => 'gray',
            self::SENT => 'info',
            self::DELIVERED => 'warning',
            self::READ => 'success',
            self::FAILED => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::PENDING => 'heroicon-o-clock',
            self::SENT => 'heroicon-o-check',
            self::DELIVERED => 'heroicon-o-check-badge',
            self::READ => 'heroicon-o-eye',
            self::FAILED => 'heroicon-o-x-circle',
        };
    }

    public function isFinal(): bool
    {
        return in_array($this, [self::READ, self::FAILED], true);
    }

    public function isSuccess(): bool
    {
        return in_array($this, [self::SENT, self::DELIVERED, self::READ], true);
    }

    public function isFailed(): bool
    {
        return $this === self::FAILED;
    }
}
