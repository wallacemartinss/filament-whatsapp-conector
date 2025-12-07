<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Data\Webhooks;

use Spatie\LaravelData\Data;

class QrCodeUpdatedData extends Data
{
    public function __construct(
        public string $instanceName,
        public ?string $code = null,
        public ?string $base64 = null,
        public ?string $pairingCode = null,
    ) {}

    public static function fromWebhook(array $data): self
    {
        $qrData = $data['data'] ?? $data;

        return new self(
            instanceName: $data['instance'] ?? $data['instanceName'] ?? '',
            code: $qrData['qrcode']['code'] ?? $qrData['code'] ?? null,
            base64: $qrData['qrcode']['base64'] ?? $qrData['base64'] ?? null,
            pairingCode: $qrData['qrcode']['pairingCode'] ?? $qrData['pairingCode'] ?? null,
        );
    }

    public function hasQrCode(): bool
    {
        return ! empty($this->base64) || ! empty($this->code);
    }
}
