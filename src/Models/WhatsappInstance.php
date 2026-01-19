<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;
use WallaceMartinss\FilamentEvolution\Enums\StatusConnectionEnum;
use WallaceMartinss\FilamentEvolution\Models\Concerns\HasTenant;
use WallaceMartinss\FilamentEvolution\Services\EvolutionClient;

class WhatsappInstance extends Model
{
    use HasFactory;
    use HasTenant;
    use HasUuids;
    use SoftDeletes;

    protected $table = 'whatsapp_instances';

    protected static function booted(): void
    {
        static::forceDeleting(function (WhatsappInstance $instance) {
            try {
                $client = app(EvolutionClient::class);

                // First try to logout (disconnect) if connected
                try {
                    $client->logoutInstance($instance->name);
                    Log::info('WhatsApp instance logged out from Evolution API', [
                        'instance_name' => $instance->name,
                    ]);
                } catch (\Exception $e) {
                    // Ignore logout errors - instance might already be disconnected
                }

                // Then delete the instance
                $client->deleteInstance($instance->name);

                Log::info('WhatsApp instance deleted from Evolution API', [
                    'instance_id' => $instance->id,
                    'instance_name' => $instance->name,
                ]);
            } catch (\Exception $e) {
                Log::warning('Failed to delete WhatsApp instance from Evolution API', [
                    'instance_id' => $instance->id,
                    'instance_name' => $instance->name,
                    'error' => $e->getMessage(),
                ]);
            }
        });
    }

    protected $fillable = [
        'name',
        'number',
        'instance_id',
        'profile_picture_url',
        'status',
        'reject_call',
        'msg_call',
        'groups_ignore',
        'always_online',
        'read_messages',
        'read_status',
        'sync_full_history',
        'count',
        'pairing_code',
        'qr_code',
    ];

    protected function casts(): array
    {
        return [
            'status' => StatusConnectionEnum::class,
            'reject_call' => 'boolean',
            'groups_ignore' => 'boolean',
            'always_online' => 'boolean',
            'read_messages' => 'boolean',
            'read_status' => 'boolean',
            'sync_full_history' => 'boolean',
        ];
    }

    public function messages(): HasMany
    {
        return $this->hasMany(WhatsappMessage::class, 'instance_id');
    }

    public function webhooks(): HasMany
    {
        return $this->hasMany(WhatsappWebhook::class, 'instance_id');
    }

    public function isConnected(): bool
    {
        return $this->status === StatusConnectionEnum::OPEN;
    }

    public function isDisconnected(): bool
    {
        return in_array($this->status, [
            StatusConnectionEnum::CLOSE,
            StatusConnectionEnum::REFUSED,
        ], true);
    }

    public function isConnecting(): bool
    {
        return $this->status === StatusConnectionEnum::CONNECTING;
    }

    public function hasQrCode(): bool
    {
        return ! empty($this->qr_code);
    }

    public function hasPairingCode(): bool
    {
        return ! empty($this->pairing_code);
    }

    public function clearQrCode(): void
    {
        $this->update([
            'qr_code' => null,
            'pairing_code' => null,
        ]);
    }

    public function getFormattedNumber(): string
    {
        return preg_replace('/\D/', '', $this->number ?? '');
    }
}
