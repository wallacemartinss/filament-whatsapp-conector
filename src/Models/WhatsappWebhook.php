<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use WallaceMartinss\FilamentEvolution\Enums\WebhookEventEnum;
use WallaceMartinss\FilamentEvolution\Models\Concerns\HasTenant;

class WhatsappWebhook extends Model
{
    use HasFactory;
    use HasTenant;

    protected $table = 'whatsapp_webhooks';

    protected $fillable = [
        'instance_id',
        'event',
        'payload',
        'processed',
        'error',
        'processing_time_ms',
    ];

    protected function casts(): array
    {
        return [
            'event' => WebhookEventEnum::class,
            'payload' => 'array',
            'processed' => 'boolean',
            'processing_time_ms' => 'integer',
        ];
    }

    public function instance(): BelongsTo
    {
        return $this->belongsTo(WhatsappInstance::class, 'instance_id');
    }

    public function isProcessed(): bool
    {
        return $this->processed;
    }

    public function hasError(): bool
    {
        return ! empty($this->error);
    }

    public function markAsProcessed(?int $processingTimeMs = null): void
    {
        $this->update([
            'processed' => true,
            'processing_time_ms' => $processingTimeMs,
        ]);
    }

    public function markAsFailed(string $error, ?int $processingTimeMs = null): void
    {
        $this->update([
            'processed' => false,
            'error' => $error,
            'processing_time_ms' => $processingTimeMs,
        ]);
    }

    public function getEventLabel(): string
    {
        return $this->event?->getLabel() ?? $this->getRawOriginal('event') ?? 'Unknown';
    }

    public function scopePending($query)
    {
        return $query->where('processed', false)->whereNull('error');
    }

    public function scopeFailed($query)
    {
        return $query->where('processed', false)->whereNotNull('error');
    }

    public function scopeProcessed($query)
    {
        return $query->where('processed', true);
    }

    public function scopeByEvent($query, WebhookEventEnum $event)
    {
        return $query->where('event', $event->value);
    }
}
