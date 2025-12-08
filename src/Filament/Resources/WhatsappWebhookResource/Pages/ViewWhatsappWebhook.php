<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Filament\Resources\WhatsappWebhookResource\Pages;

use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use WallaceMartinss\FilamentEvolution\Filament\Resources\WhatsappWebhookResource;

class ViewWhatsappWebhook extends ViewRecord
{
    protected static string $resource = WhatsappWebhookResource::class;

    public function infolist(Schema $infolist): Schema
    {
        return $infolist
            ->columns(1)
            ->schema([
                Section::make(__('filament-evolution::webhook.sections.webhook_info'))
                    ->schema([
                        TextEntry::make('instance.name')
                            ->label(__('filament-evolution::webhook.fields.instance'))
                            ->placeholder('-'),

                        TextEntry::make('event')
                            ->label(__('filament-evolution::webhook.fields.event'))
                            ->badge(),

                        TextEntry::make('processed')
                            ->label(__('filament-evolution::webhook.fields.processed'))
                            ->badge()
                            ->formatStateUsing(fn ($state) => $state ? __('filament-evolution::webhook.status.yes') : __('filament-evolution::webhook.status.no'))
                            ->color(fn ($state) => $state ? 'success' : 'warning'),

                        TextEntry::make('processing_time_ms')
                            ->label(__('filament-evolution::webhook.fields.processing_time'))
                            ->suffix(' ms')
                            ->placeholder('-'),

                        TextEntry::make('created_at')
                            ->label(__('filament-evolution::webhook.fields.created_at'))
                            ->dateTime(),

                        TextEntry::make('updated_at')
                            ->label(__('filament-evolution::webhook.fields.updated_at'))
                            ->dateTime(),
                    ])
                    ->columns(3),

                Section::make(__('filament-evolution::webhook.sections.error'))
                    ->schema([
                        TextEntry::make('error')
                            ->label('')
                            ->columnSpanFull()
                            ->prose()
                            ->color('danger'),
                    ])
                    ->visible(fn ($record) => ! empty($record->error)),

                Section::make(__('filament-evolution::webhook.sections.payload'))
                    ->schema([
                        TextEntry::make('payload_display')
                            ->hiddenLabel()
                            ->state(fn ($record) => $this->formatPayloadAsHtml($record->payload))
                            ->html()
                            ->copyable()
                            ->copyableState(fn ($record) => $this->formatPayloadAsText($record->payload))
                            ->copyMessage('Payload copiado!')
                            ->copyMessageDuration(1500),
                    ])
                    ->icon('heroicon-o-code-bracket')
                    ->collapsible()
                    ->collapsed(false),
            ]);
    }

    protected function formatPayloadAsHtml(mixed $payload): string
    {
        if (empty($payload)) {
            return '<pre class="language-json p-4 rounded-lg overflow-x-auto m-0 border" style="background-color: #1e293b; color: #e2e8f0; border-color: #334155;"><code>{}</code></pre>';
        }

        // Se for string, decodifica
        if (is_string($payload)) {
            $decoded = json_decode($payload, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $payload = $decoded;
            }
        }

        $json = json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        // Aplica syntax highlighting
        $highlighted = htmlspecialchars($json, ENT_QUOTES, 'UTF-8');

        // Colore keys (strings antes de :)
        $highlighted = preg_replace('/&quot;([^&]*)&quot;(\s*:)/', '<span style="color: #7dd3fc;">"$1"</span>$2', $highlighted);

        // Colore valores string (após os dois pontos)
        $highlighted = preg_replace('/:\s*&quot;([^&]*)&quot;/', ': <span style="color: #86efac;">"$1"</span>', $highlighted);

        // Colore números
        $highlighted = preg_replace('/:\s*(-?\d+\.?\d*)([,\n\r\s])/', ': <span style="color: #34d399;">$1</span>$2', $highlighted);

        // Colore booleanos
        $highlighted = preg_replace('/:\s*(true|false)/', ': <span style="color: #fbbf24;">$1</span>', $highlighted);

        // Colore null
        $highlighted = preg_replace('/:\s*(null)/', ': <span style="color: #c084fc;">$1</span>', $highlighted);

        return '<pre class="language-json p-4 rounded-lg overflow-x-auto m-0 border" style="background-color: #1e293b; color: #e2e8f0; border-color: #334155;"><code style="font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace; font-size: 0.875rem; line-height: 1.5; white-space: pre; display: block;">'.$highlighted.'</code></pre>';
    }

    protected function formatPayloadAsText(mixed $payload): string
    {
        if (empty($payload)) {
            return '{}';
        }

        if (is_string($payload)) {
            $decoded = json_decode($payload, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $payload = $decoded;
            }
        }

        return json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
