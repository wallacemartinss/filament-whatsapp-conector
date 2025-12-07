<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Data;

use Spatie\LaravelData\Data;

class InstanceData extends Data
{
    public function __construct(
        public string $instanceName,
        public ?string $number = null,
        public bool $qrcode = true,
        public bool $rejectCall = false,
        public ?string $msgCall = null,
        public bool $groupsIgnore = false,
        public bool $alwaysOnline = false,
        public bool $readMessages = false,
        public bool $readStatus = false,
        public bool $syncFullHistory = false,
        public ?array $webhook = null,
    ) {}

    public static function fromApiResponse(array $data): self
    {
        return new self(
            instanceName: $data['instance']['instanceName'] ?? $data['instanceName'] ?? '',
            number: $data['instance']['number'] ?? $data['number'] ?? null,
            qrcode: $data['qrcode'] ?? true,
        );
    }

    public function toApiPayload(): array
    {
        $payload = [
            'instanceName' => $this->instanceName,
            'qrcode' => $this->qrcode,
            'integration' => 'WHATSAPP-BAILEYS',
        ];

        if ($this->number) {
            $payload['number'] = $this->number;
        }

        $settings = array_filter([
            'reject_call' => $this->rejectCall,
            'msg_call' => $this->msgCall,
            'groups_ignore' => $this->groupsIgnore,
            'always_online' => $this->alwaysOnline,
            'read_messages' => $this->readMessages,
            'read_status' => $this->readStatus,
            'sync_full_history' => $this->syncFullHistory,
        ], fn ($value) => $value !== null && $value !== false && $value !== '');

        if (! empty($settings)) {
            $payload = array_merge($payload, $settings);
        }

        if ($this->webhook) {
            $payload['webhook'] = $this->webhook;
        }

        return $payload;
    }
}
