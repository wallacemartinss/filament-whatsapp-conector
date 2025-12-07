<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;
use WallaceMartinss\FilamentEvolution\Enums\StatusConnectionEnum;
use WallaceMartinss\FilamentEvolution\Exceptions\EvolutionApiException;
use WallaceMartinss\FilamentEvolution\Models\WhatsappInstance;
use WallaceMartinss\FilamentEvolution\Services\EvolutionClient;

class QrCodeDisplay extends Component
{
    public WhatsappInstance $instance;

    public ?string $qrCode = null;

    public ?string $pairingCode = null;

    public bool $isConnected = false;

    public bool $isLoading = true;

    public ?string $error = null;

    public int $qrCodeExpiresIn = 30;

    public int $qrCodeTtl = 30;

    public function mount(WhatsappInstance $instance): void
    {
        $this->instance = $instance;
        $this->qrCodeTtl = (int) config('filament-evolution.instance.qrcode_expires_in', 30);
        $this->qrCodeExpiresIn = $this->qrCodeTtl;
        $this->fetchQrCode();
    }

    public function checkConnection(): void
    {
        $this->error = null;

        try {
            $client = app(EvolutionClient::class);

            // Check current connection state
            $state = $client->getConnectionState($this->instance->name);

            $connectionState = $state['state'] ?? $state['instance']['state'] ?? 'close';

            if ($connectionState === 'open') {
                $this->isConnected = true;
                $this->qrCode = null;
                $this->pairingCode = null;
                $this->instance->update(['status' => StatusConnectionEnum::OPEN]);
                $this->dispatch('instance-connected');
            }
        } catch (EvolutionApiException $e) {
            // Don't show error during poll - instance might not exist yet
            if (! $this->qrCode) {
                $this->fetchQrCode();
            }
        }
    }

    public function fetchQrCode(): void
    {
        try {
            $client = app(EvolutionClient::class);
            $response = $client->connectInstance($this->instance->name);

            $this->qrCode = $response['base64'] ?? $response['qrcode']['base64'] ?? null;
            $this->pairingCode = $response['pairingCode'] ?? $response['qrcode']['pairingCode'] ?? null;

            // Update instance with QR code data
            $this->instance->update([
                'qr_code' => $this->qrCode,
                'pairing_code' => $this->pairingCode,
                'qr_code_updated_at' => now(),
                'status' => StatusConnectionEnum::CONNECTING,
            ]);

            $this->qrCodeExpiresIn = $this->qrCodeTtl;
            $this->isLoading = false;

            // Dispatch event to reset Alpine countdown
            $this->dispatch('qrCodeRefreshed');
        } catch (EvolutionApiException $e) {
            $this->error = $e->getMessage();
            $this->isLoading = false;
        }
    }

    public function refreshQrCode(): void
    {
        $this->isLoading = true;
        $this->fetchQrCode();
    }

    #[Computed]
    public function statusColor(): string
    {
        if ($this->isConnected) {
            return 'success';
        }

        if ($this->error) {
            return 'danger';
        }

        if ($this->qrCode) {
            return 'warning';
        }

        return 'gray';
    }

    #[Computed]
    public function statusLabel(): string
    {
        if ($this->isConnected) {
            return __('filament-evolution::qrcode.connected');
        }

        if ($this->error) {
            return __('filament-evolution::qrcode.error');
        }

        if ($this->qrCode) {
            return __('filament-evolution::qrcode.waiting_scan');
        }

        return __('filament-evolution::qrcode.loading');
    }

    public function render()
    {
        return view('filament-evolution::livewire.qr-code-display');
    }
}
