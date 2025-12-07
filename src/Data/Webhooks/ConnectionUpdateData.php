<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Data\Webhooks;

use Spatie\LaravelData\Data;
use WallaceMartinss\FilamentEvolution\Enums\StatusConnectionEnum;

class ConnectionUpdateData extends Data
{
    public function __construct(
        public string $instanceName,
        public string $state,
        public ?StatusConnectionEnum $status = null,
    ) {}

    public static function fromWebhook(array $data): self
    {
        $state = $data['state'] ?? $data['data']['state'] ?? 'close';

        return new self(
            instanceName: $data['instance'] ?? $data['instanceName'] ?? '',
            state: $state,
            status: self::mapStateToStatus($state),
        );
    }

    protected static function mapStateToStatus(string $state): StatusConnectionEnum
    {
        return match (strtolower($state)) {
            'open', 'connected' => StatusConnectionEnum::OPEN,
            'connecting' => StatusConnectionEnum::CONNECTING,
            'close', 'closed', 'disconnected' => StatusConnectionEnum::CLOSE,
            default => StatusConnectionEnum::REFUSED,
        };
    }

    public function isConnected(): bool
    {
        return $this->status === StatusConnectionEnum::OPEN;
    }
}
