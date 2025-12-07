<x-filament-panels::page>
    {{ $this->table }}

    {{-- QR Code Modal --}}
    <x-filament::modal id="qr-code-modal" width="md" :close-by-clicking-away="false">
        <x-slot name="heading">
            @if ($this->connectInstance)
                {{ __('filament-evolution::qrcode.modal_title', ['instance' => $this->connectInstance->name]) }}
            @endif
        </x-slot>

        @if ($this->connectInstance && $this->showQrCodeModal)
            <livewire:filament-evolution::qr-code-display :instance="$this->connectInstance" :key="'qr-' . $this->connectInstance->id" />
        @endif
    </x-filament::modal>
</x-filament-panels::page>
