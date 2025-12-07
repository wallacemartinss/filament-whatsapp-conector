<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Messaggi',
    'model_label' => 'Messaggio',
    'plural_model_label' => 'Messaggi',

    'sections' => [
        'message_info' => 'Informazioni Messaggio',
        'content' => 'Contenuto',
        'timestamps' => 'Timestamp',
        'raw_payload' => 'Dati Grezzi',
    ],

    'fields' => [
        'instance' => 'Istanza',
        'direction' => 'Direzione',
        'phone' => 'Telefono',
        'type' => 'Tipo',
        'content' => 'Contenuto',
        'status' => 'Stato',
        'message_id' => 'ID Messaggio',
        'media' => 'Media',
        'media_caption' => 'Didascalia Media',
        'media_url' => 'URL Media',
        'location' => 'Posizione',
        'sent_at' => 'Inviato il',
        'delivered_at' => 'Consegnato il',
        'read_at' => 'Letto il',
        'created_at' => 'Creato il',
    ],
];
