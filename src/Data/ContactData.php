<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Data;

use Spatie\LaravelData\Data;

class ContactData extends Data
{
    public function __construct(
        public string $jid,
        public ?string $name = null,
        public ?string $number = null,
        public ?string $profilePictureUrl = null,
        public bool $exists = true,
    ) {}

    public static function fromApiResponse(array $data): self
    {
        return new self(
            jid: $data['jid'] ?? $data['id'] ?? '',
            name: $data['name'] ?? $data['pushName'] ?? null,
            number: $data['number'] ?? self::extractNumberFromJid($data['jid'] ?? $data['id'] ?? ''),
            profilePictureUrl: $data['profilePictureUrl'] ?? $data['picture'] ?? null,
            exists: $data['exists'] ?? true,
        );
    }

    protected static function extractNumberFromJid(string $jid): string
    {
        return str_replace(['@s.whatsapp.net', '@g.us'], '', $jid);
    }

    public function isGroup(): bool
    {
        return str_contains($this->jid, '@g.us');
    }
}
