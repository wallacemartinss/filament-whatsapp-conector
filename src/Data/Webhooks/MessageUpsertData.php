<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Data\Webhooks;

use Spatie\LaravelData\Data;
use WallaceMartinss\FilamentEvolution\Data\MessageData;
use WallaceMartinss\FilamentEvolution\Enums\MessageDirectionEnum;

class MessageUpsertData extends Data
{
    public function __construct(
        public string $instanceName,
        public MessageData $message,
        public array $rawData = [],
    ) {}

    public static function fromWebhook(array $data): self
    {
        $messageData = $data['data'] ?? $data;

        return new self(
            instanceName: $data['instance'] ?? $data['instanceName'] ?? '',
            message: MessageData::fromApiResponse(
                $messageData,
                self::detectDirection($messageData)
            ),
            rawData: $data,
        );
    }

    protected static function detectDirection(array $data): MessageDirectionEnum
    {
        $key = $data['key'] ?? [];

        if (isset($key['fromMe']) && $key['fromMe'] === true) {
            return MessageDirectionEnum::OUTGOING;
        }

        return MessageDirectionEnum::INCOMING;
    }
}
