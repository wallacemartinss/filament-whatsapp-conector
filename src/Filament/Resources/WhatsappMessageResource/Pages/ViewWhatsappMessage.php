<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Filament\Resources\WhatsappMessageResource\Pages;

use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use WallaceMartinss\FilamentEvolution\Filament\Resources\WhatsappMessageResource;

class ViewWhatsappMessage extends ViewRecord
{
    protected static string $resource = WhatsappMessageResource::class;

    public function infolist(Schema $infolist): Schema
    {
        return $infolist
            ->columns(1)
            ->schema([
                Section::make(__('filament-evolution::message.sections.message_info'))
                    ->schema([
                        TextEntry::make('instance.name')
                            ->label(__('filament-evolution::message.fields.instance')),

                        TextEntry::make('direction')
                            ->label(__('filament-evolution::message.fields.direction'))
                            ->badge(),

                        TextEntry::make('phone')
                            ->label(__('filament-evolution::message.fields.phone'))
                            ->copyable(),

                        TextEntry::make('type')
                            ->label(__('filament-evolution::message.fields.type'))
                            ->badge(),

                        TextEntry::make('status')
                            ->label(__('filament-evolution::message.fields.status'))
                            ->badge(),

                        TextEntry::make('message_id')
                            ->label(__('filament-evolution::message.fields.message_id'))
                            ->copyable(),
                    ])
                    ->columns(3),

                Section::make(__('filament-evolution::message.sections.content'))
                    ->schema([
                        TextEntry::make('content.text')
                            ->label(__('filament-evolution::message.fields.content'))
                            ->columnSpanFull()
                            ->prose()
                            ->placeholder('-'),

                        TextEntry::make('content.media_caption')
                            ->label(__('filament-evolution::message.fields.media_caption'))
                            ->columnSpanFull()
                            ->visible(fn ($record) => ! empty($record->content['media_caption'])),

                        TextEntry::make('content.media_url')
                            ->label(__('filament-evolution::message.fields.media_url'))
                            ->columnSpanFull()
                            ->url(fn ($state) => $state)
                            ->visible(fn ($record) => ! empty($record->content['media_url'])),

                        TextEntry::make('location')
                            ->label(__('filament-evolution::message.fields.location'))
                            ->state(fn ($record) => $record->content['latitude'] && $record->content['longitude']
                                ? "Lat: {$record->content['latitude']}, Lng: {$record->content['longitude']}"
                                : null)
                            ->visible(fn ($record) => ! empty($record->content['latitude']) && ! empty($record->content['longitude'])),

                        TextEntry::make('media')
                            ->label(__('filament-evolution::message.fields.media'))
                            ->columnSpanFull()
                            ->state(fn ($record) => $this->formatPayloadAsHtml($record->media))
                            ->html()
                            ->visible(fn ($record) => ! empty($record->media)),
                    ]),

                Section::make(__('filament-evolution::message.sections.timestamps'))
                    ->schema([
                        TextEntry::make('sent_at')
                            ->label(__('filament-evolution::message.fields.sent_at'))
                            ->dateTime(),

                        TextEntry::make('delivered_at')
                            ->label(__('filament-evolution::message.fields.delivered_at'))
                            ->dateTime(),

                        TextEntry::make('read_at')
                            ->label(__('filament-evolution::message.fields.read_at'))
                            ->dateTime(),

                        TextEntry::make('created_at')
                            ->label(__('filament-evolution::message.fields.created_at'))
                            ->dateTime(),
                    ])
                    ->columns(4),

                Section::make(__('filament-evolution::message.sections.raw_payload'))
                    ->schema([
                        TextEntry::make('raw_payload_display')
                            ->hiddenLabel()
                            ->state(fn ($record) => $this->formatPayloadAsHtml($record->raw_payload))
                            ->html()
                            ->copyable()
                            ->copyableState(fn ($record) => $this->formatPayloadAsText($record->raw_payload))
                            ->copyMessage('Payload copiado!')
                            ->copyMessageDuration(1500),
                    ])
                    ->icon('heroicon-o-code-bracket')
                    ->collapsible()
                    ->collapsed(),
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
