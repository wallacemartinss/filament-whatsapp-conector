<?php

declare(strict_types=1);

return [
    'status_connection' => [
        'open' => 'Connesso',
        'connecting' => 'Connessione',
        'close' => 'Disconnesso',
        'refused' => 'Rifiutato',
    ],

    'message_type' => [
        'text' => 'Testo',
        'image' => 'Immagine',
        'audio' => 'Audio',
        'video' => 'Video',
        'document' => 'Documento',
        'location' => 'Posizione',
        'contact' => 'Contatto',
        'sticker' => 'Sticker',
    ],

    'message_direction' => [
        'incoming' => 'In Arrivo',
        'outgoing' => 'In Uscita',
    ],

    'message_status' => [
        'pending' => 'In Attesa',
        'sent' => 'Inviato',
        'delivered' => 'Consegnato',
        'read' => 'Letto',
        'failed' => 'Fallito',
    ],

    'webhook_event' => [
        'application_startup' => 'Avvio Applicazione',
        'qrcode_updated' => 'Codice QR Aggiornato',
        'connection_update' => 'Aggiornamento Connessione',
        'messages_set' => 'Messaggi Impostati',
        'messages_upsert' => 'Messaggio Ricevuto',
        'messages_update' => 'Messaggio Aggiornato',
        'messages_delete' => 'Messaggio Eliminato',
        'send_message' => 'Messaggio Inviato',
        'presence_update' => 'Aggiornamento Presenza',
        'new_token' => 'Nuovo Token',
        'logout_instance' => 'Logout Istanza',
        'remove_instance' => 'Istanza Rimossa',
    ],
];
