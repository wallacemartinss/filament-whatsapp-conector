<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use WallaceMartinss\FilamentEvolution\Enums\MessageDirectionEnum;
use WallaceMartinss\FilamentEvolution\Enums\MessageStatusEnum;
use WallaceMartinss\FilamentEvolution\Enums\MessageTypeEnum;
use WallaceMartinss\FilamentEvolution\Models\Concerns\HasTenant;

class WhatsappMessage extends Model
{
    use HasFactory;
    use HasTenant;
    use HasUuids;

    protected $table = 'whatsapp_messages';

    protected $fillable = [
        'instance_id',
        'message_id',
        'remote_jid',
        'phone',
        'direction',
        'type',
        'content',
        'media',
        'status',
        'raw_payload',
        'sent_at',
        'delivered_at',
        'read_at',
    ];

    protected function casts(): array
    {
        return [
            'direction' => MessageDirectionEnum::class,
            'type' => MessageTypeEnum::class,
            'status' => MessageStatusEnum::class,
            'content' => 'array',
            'media' => 'array',
            'raw_payload' => 'array',
            'sent_at' => 'datetime',
            'delivered_at' => 'datetime',
            'read_at' => 'datetime',
        ];
    }

    public function instance(): BelongsTo
    {
        return $this->belongsTo(WhatsappInstance::class, 'instance_id');
    }

    public function isIncoming(): bool
    {
        return $this->direction === MessageDirectionEnum::INCOMING;
    }

    public function isOutgoing(): bool
    {
        return $this->direction === MessageDirectionEnum::OUTGOING;
    }

    public function isMedia(): bool
    {
        return $this->type?->isMedia() ?? false;
    }

    public function isText(): bool
    {
        return $this->type === MessageTypeEnum::TEXT;
    }

    public function isSent(): bool
    {
        return $this->status?->isSuccess() ?? false;
    }

    public function isFailed(): bool
    {
        return $this->status === MessageStatusEnum::FAILED;
    }

    public function getFormattedPhone(): string
    {
        return preg_replace('/\D/', '', $this->phone ?? '');
    }

    public function markAsSent(): void
    {
        $this->update([
            'status' => MessageStatusEnum::SENT,
            'sent_at' => now(),
        ]);
    }

    public function markAsDelivered(): void
    {
        $this->update([
            'status' => MessageStatusEnum::DELIVERED,
            'delivered_at' => now(),
        ]);
    }

    public function markAsRead(): void
    {
        $this->update([
            'status' => MessageStatusEnum::READ,
            'read_at' => now(),
        ]);
    }

    public function markAsFailed(): void
    {
        $this->update([
            'status' => MessageStatusEnum::FAILED,
        ]);
    }
}
