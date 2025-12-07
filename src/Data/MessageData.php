<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Data;

use Spatie\LaravelData\Data;
use WallaceMartinss\FilamentEvolution\Enums\MessageDirectionEnum;
use WallaceMartinss\FilamentEvolution\Enums\MessageStatusEnum;
use WallaceMartinss\FilamentEvolution\Enums\MessageTypeEnum;

class MessageData extends Data
{
    public function __construct(
        public string $messageId,
        public string $phone,
        public MessageTypeEnum $type,
        public MessageDirectionEnum $direction,
        public MessageStatusEnum $status,
        public ?string $text = null,
        public ?string $mediaUrl = null,
        public ?string $mediaCaption = null,
        public ?string $mimetype = null,
        public ?float $latitude = null,
        public ?float $longitude = null,
        public ?string $contactName = null,
        public ?string $contactNumber = null,
        public ?array $rawData = null,
    ) {}

    public static function fromApiResponse(array $data, MessageDirectionEnum $direction): self
    {
        $key = $data['key'] ?? [];
        $message = $data['message'] ?? [];

        return new self(
            messageId: $key['id'] ?? $data['id'] ?? '',
            phone: $key['remoteJid'] ?? $data['remoteJid'] ?? '',
            type: self::detectMessageType($message),
            direction: $direction,
            status: MessageStatusEnum::SENT,
            text: $message['conversation'] ?? $message['extendedTextMessage']['text'] ?? null,
            mediaUrl: $message['imageMessage']['url'] ?? $message['audioMessage']['url'] ?? $message['documentMessage']['url'] ?? null,
            mediaCaption: $message['imageMessage']['caption'] ?? $message['documentMessage']['caption'] ?? null,
            mimetype: $message['imageMessage']['mimetype'] ?? $message['audioMessage']['mimetype'] ?? $message['documentMessage']['mimetype'] ?? null,
            latitude: isset($message['locationMessage']) ? ($message['locationMessage']['degreesLatitude'] ?? null) : null,
            longitude: isset($message['locationMessage']) ? ($message['locationMessage']['degreesLongitude'] ?? null) : null,
            rawData: $data,
        );
    }

    protected static function detectMessageType(array $message): MessageTypeEnum
    {
        if (isset($message['imageMessage'])) {
            return MessageTypeEnum::IMAGE;
        }

        if (isset($message['audioMessage'])) {
            return MessageTypeEnum::AUDIO;
        }

        if (isset($message['videoMessage'])) {
            return MessageTypeEnum::VIDEO;
        }

        if (isset($message['documentMessage'])) {
            return MessageTypeEnum::DOCUMENT;
        }

        if (isset($message['stickerMessage'])) {
            return MessageTypeEnum::STICKER;
        }

        if (isset($message['locationMessage'])) {
            return MessageTypeEnum::LOCATION;
        }

        if (isset($message['contactMessage']) || isset($message['contactsArrayMessage'])) {
            return MessageTypeEnum::CONTACT;
        }

        return MessageTypeEnum::TEXT;
    }

    public function isMedia(): bool
    {
        return in_array($this->type, [
            MessageTypeEnum::IMAGE,
            MessageTypeEnum::AUDIO,
            MessageTypeEnum::VIDEO,
            MessageTypeEnum::DOCUMENT,
        ]);
    }
}
