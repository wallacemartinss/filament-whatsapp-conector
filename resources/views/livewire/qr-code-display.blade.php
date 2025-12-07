<div x-data="{
    countdown: {{ $qrCodeTtl }},
    ttl: {{ $qrCodeTtl }},
    timer: null,
    init() {
        this.startCountdown();

        // Listen for QR code refresh to reset countdown
        Livewire.on('qrCodeRefreshed', () => {
            this.countdown = this.ttl;
            this.startCountdown();
        });
    },
    startCountdown() {
        if (this.timer) clearInterval(this.timer);

        this.timer = setInterval(() => {
            if (this.countdown > 0) {
                this.countdown--;
            } else {
                clearInterval(this.timer);
                $wire.fetchQrCode();
            }
        }, 1000);
    }
}" x-init="init()" @instance-connected.window="clearInterval(timer)"
    wire:poll.5s="checkConnection" class="w-full">
    {{-- Loading State --}}
    @if ($isLoading)
        <div class="flex flex-col items-center justify-center py-16">
            <div class="relative">
                <div class="w-16 h-16 border-4 border-gray-200 dark:border-gray-700 rounded-full"></div>
                <div
                    class="absolute top-0 left-0 w-16 h-16 border-4 border-primary-500 border-t-transparent rounded-full animate-spin">
                </div>
            </div>
            <p class="mt-6 text-sm font-medium text-gray-500 dark:text-gray-400">
                {{ __('filament-evolution::qrcode.loading') }}
            </p>
        </div>
    @elseif($isConnected)
        {{-- Connected State --}}
        <div class="flex flex-col items-center justify-center py-12">
            <div class="relative">
                <div class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7">
                        </path>
                    </svg>
                </div>
            </div>
            <h3 class="mt-6 text-lg font-semibold text-gray-900 dark:text-white">
                {{ __('filament-evolution::qrcode.connected_title') }}
            </h3>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 text-center">
                {{ __('filament-evolution::qrcode.connected_description') }}
            </p>
        </div>
    @elseif($error)
        {{-- Error State --}}
        <div class="flex flex-col items-center justify-center py-12">
            <div class="w-20 h-20 bg-red-500 rounded-full flex items-center justify-center">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </div>
            <h3 class="mt-6 text-lg font-semibold text-gray-900 dark:text-white">
                {{ __('filament-evolution::qrcode.error_title') }}
            </h3>
            <p class="mt-2 text-sm text-red-500 text-center">
                {{ $error }}
            </p>
            <button wire:click="fetchQrCode"
                class="mt-4 px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700">
                {{ __('filament-evolution::qrcode.try_again') }}
            </button>
        </div>
    @elseif($qrCode)
        {{-- QR Code Display --}}
        <div class="flex flex-col items-center">
            {{-- Status --}}
            <div class="flex items-center gap-2 mb-4">
                <span class="relative flex h-3 w-3">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-amber-500"></span>
                </span>
                <span class="text-sm font-medium text-gray-600 dark:text-gray-300">
                    {{ __('filament-evolution::qrcode.waiting_scan') }}
                </span>
            </div>

            {{-- QR Code --}}
            <div class="bg-white p-3 rounded-xl shadow-lg">
                <img src="{{ $qrCode }}" alt="QR Code" class="w-56 h-56" />
            </div>

            {{-- Countdown Timer with Alpine --}}
            <div class="mt-3 flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>
                    {{ __('filament-evolution::qrcode.expires_in') }}:
                    <strong class="text-gray-700 dark:text-gray-200" x-text="countdown + 's'"></strong>
                </span>
            </div>

            {{-- Instructions --}}
            <p class="mt-4 text-sm text-gray-600 dark:text-gray-400 text-center max-w-xs">
                {{ __('filament-evolution::qrcode.scan_instructions') }}
            </p>

            {{-- Pairing Code --}}
            @if ($pairingCode)
                <div class="mt-4 text-center">
                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">
                        {{ __('filament-evolution::qrcode.or_use_code') }}
                    </p>
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 dark:bg-gray-800 rounded-lg">
                        <span class="font-mono text-xl font-bold tracking-widest text-gray-900 dark:text-white">
                            {{ $pairingCode }}
                        </span>
                    </div>
                </div>
            @endif

            {{-- Refresh Button --}}
            <button wire:click="refreshQrCode" wire:loading.attr="disabled"
                class="mt-4 flex items-center gap-2 text-sm text-primary-600 dark:text-primary-400 hover:text-primary-700">
                <svg wire:loading.class="animate-spin" class="w-4 h-4" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                    </path>
                </svg>
                {{ __('filament-evolution::qrcode.refresh') }}
            </button>
        </div>
    @else
        {{-- No QR Code - Generate --}}
        <div class="flex flex-col items-center justify-center py-12">
            <button wire:click="fetchQrCode" wire:loading.attr="disabled"
                class="px-6 py-3 bg-primary-600 text-white text-sm font-semibold rounded-lg hover:bg-primary-700 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                    </path>
                </svg>
                {{ __('filament-evolution::qrcode.generate') }}
            </button>
        </div>
    @endif
</div>
