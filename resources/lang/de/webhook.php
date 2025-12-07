<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Webhook-Protokolle',
    'model_label' => 'Webhook-Protokoll',
    'plural_model_label' => 'Webhook-Protokolle',

    'sections' => [
        'webhook_info' => 'Webhook-Informationen',
        'payload' => 'Nutzlast',
        'error' => 'Fehler',
    ],

    'fields' => [
        'instance' => 'Instanz',
        'event' => 'Ereignis',
        'processed' => 'Verarbeitet',
        'has_error' => 'Hat Fehler',
        'error' => 'Fehler',
        'processing_time' => 'Verarbeitungszeit',
        'created_at' => 'Erstellt am',
        'updated_at' => 'Aktualisiert am',
    ],

    'status' => [
        'yes' => 'Ja',
        'no' => 'Nein',
    ],
];
