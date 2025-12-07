<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Data;

use Spatie\LaravelData\Data;

class QrCodeData extends Data
{
    public function __construct(
        public ?string $code = null,
        public ?string $base64 = null,
        public ?string $pairingCode = null,
        public int $count = 0,
    ) {}

    public static function fromApiResponse(array $data): self
    {
        return new self(
            code: $data['code'] ?? null,
            base64: $data['base64'] ?? null,
            pairingCode: $data['pairingCode'] ?? null,
            count: $data['count'] ?? 0,
        );
    }

    public function hasQrCode(): bool
    {
        return ! empty($this->base64) || ! empty($this->code);
    }

    public function hasPairingCode(): bool
    {
        return ! empty($this->pairingCode);
    }
}
