<?php

declare(strict_types=1);

return [
    'status_connection' => [
        'open' => 'Verbonden',
        'connecting' => 'Verbinden',
        'close' => 'Losgekoppeld',
        'refused' => 'Geweigerd',
    ],

    'message_type' => [
        'text' => 'Tekst',
        'image' => 'Afbeelding',
        'audio' => 'Audio',
        'video' => 'Video',
        'document' => 'Document',
        'location' => 'Locatie',
        'contact' => 'Contact',
        'sticker' => 'Sticker',
    ],

    'message_direction' => [
        'incoming' => 'Inkomend',
        'outgoing' => 'Uitgaand',
    ],

    'message_status' => [
        'pending' => 'In Afwachting',
        'sent' => 'Verzonden',
        'delivered' => 'Afgeleverd',
        'read' => 'Gelezen',
        'failed' => 'Mislukt',
    ],

    'webhook_event' => [
        'application_startup' => 'Applicatie Opstart',
        'qrcode_updated' => 'QR-code Bijgewerkt',
        'connection_update' => 'Verbinding Update',
        'messages_set' => 'Berichten Ingesteld',
        'messages_upsert' => 'Bericht Ontvangen',
        'messages_update' => 'Bericht Bijgewerkt',
        'messages_delete' => 'Bericht Verwijderd',
        'send_message' => 'Bericht Verzonden',
        'presence_update' => 'Aanwezigheid Update',
        'new_token' => 'Nieuwe Token',
        'logout_instance' => 'Instantie Uitloggen',
        'remove_instance' => 'Instantie Verwijderd',
    ],
];
