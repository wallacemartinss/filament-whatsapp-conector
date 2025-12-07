<?php

declare(strict_types=1);

return [
    'status_connection' => [
        'open' => 'Verbunden',
        'connecting' => 'Verbinden',
        'close' => 'Getrennt',
        'refused' => 'Abgelehnt',
    ],

    'message_type' => [
        'text' => 'Text',
        'image' => 'Bild',
        'audio' => 'Audio',
        'video' => 'Video',
        'document' => 'Dokument',
        'location' => 'Standort',
        'contact' => 'Kontakt',
        'sticker' => 'Sticker',
    ],

    'message_direction' => [
        'incoming' => 'Eingehend',
        'outgoing' => 'Ausgehend',
    ],

    'message_status' => [
        'pending' => 'Ausstehend',
        'sent' => 'Gesendet',
        'delivered' => 'Zugestellt',
        'read' => 'Gelesen',
        'failed' => 'Fehlgeschlagen',
    ],

    'webhook_event' => [
        'application_startup' => 'Anwendungsstart',
        'qrcode_updated' => 'QR-Code aktualisiert',
        'connection_update' => 'Verbindungsaktualisierung',
        'messages_set' => 'Nachrichten gesetzt',
        'messages_upsert' => 'Nachricht empfangen',
        'messages_update' => 'Nachricht aktualisiert',
        'messages_delete' => 'Nachricht gelöscht',
        'send_message' => 'Nachricht gesendet',
        'presence_update' => 'Präsenzaktualisierung',
        'new_token' => 'Neuer Token',
        'logout_instance' => 'Instanz-Abmeldung',
        'remove_instance' => 'Instanz entfernt',
    ],
];
