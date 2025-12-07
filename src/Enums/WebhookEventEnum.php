<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Enums;

use Filament\Support\Contracts\HasLabel;

enum WebhookEventEnum: string implements HasLabel
{
    case APPLICATION_STARTUP = 'application.startup';
    case QRCODE_UPDATED = 'qrcode.updated';
    case CONNECTION_UPDATE = 'connection.update';
    case MESSAGES_SET = 'messages.set';
    case MESSAGES_UPSERT = 'messages.upsert';
    case MESSAGES_UPDATE = 'messages.update';
    case MESSAGES_DELETE = 'messages.delete';
    case SEND_MESSAGE = 'send.message';
    case PRESENCE_UPDATE = 'presence.update';
    case NEW_TOKEN = 'new.token';
    case LOGOUT_INSTANCE = 'logout.instance';
    case REMOVE_INSTANCE = 'remove.instance';

    public function getLabel(): string
    {
        return match ($this) {
            self::APPLICATION_STARTUP => __('filament-evolution::enums.webhook_event.application_startup'),
            self::QRCODE_UPDATED => __('filament-evolution::enums.webhook_event.qrcode_updated'),
            self::CONNECTION_UPDATE => __('filament-evolution::enums.webhook_event.connection_update'),
            self::MESSAGES_SET => __('filament-evolution::enums.webhook_event.messages_set'),
            self::MESSAGES_UPSERT => __('filament-evolution::enums.webhook_event.messages_upsert'),
            self::MESSAGES_UPDATE => __('filament-evolution::enums.webhook_event.messages_update'),
            self::MESSAGES_DELETE => __('filament-evolution::enums.webhook_event.messages_delete'),
            self::SEND_MESSAGE => __('filament-evolution::enums.webhook_event.send_message'),
            self::PRESENCE_UPDATE => __('filament-evolution::enums.webhook_event.presence_update'),
            self::NEW_TOKEN => __('filament-evolution::enums.webhook_event.new_token'),
            self::LOGOUT_INSTANCE => __('filament-evolution::enums.webhook_event.logout_instance'),
            self::REMOVE_INSTANCE => __('filament-evolution::enums.webhook_event.remove_instance'),
        };
    }

    public function shouldProcess(): bool
    {
        return in_array($this, [
            self::QRCODE_UPDATED,
            self::CONNECTION_UPDATE,
            self::MESSAGES_UPSERT,
            self::MESSAGES_UPDATE,
            self::SEND_MESSAGE,
        ], true);
    }

    public function isConnectionEvent(): bool
    {
        return in_array($this, [
            self::CONNECTION_UPDATE,
            self::LOGOUT_INSTANCE,
            self::REMOVE_INSTANCE,
        ], true);
    }

    public function isMessageEvent(): bool
    {
        return in_array($this, [
            self::MESSAGES_SET,
            self::MESSAGES_UPSERT,
            self::MESSAGES_UPDATE,
            self::MESSAGES_DELETE,
            self::SEND_MESSAGE,
        ], true);
    }

    public function isQrCodeEvent(): bool
    {
        return $this === self::QRCODE_UPDATED;
    }
}
