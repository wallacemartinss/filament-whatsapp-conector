<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Log Webhook',
    'model_label' => 'Log Webhook',
    'plural_model_label' => 'Log Webhook',

    'sections' => [
        'webhook_info' => 'Informazioni Webhook',
        'payload' => 'Payload',
        'error' => 'Errore',
    ],

    'fields' => [
        'instance' => 'Istanza',
        'event' => 'Evento',
        'processed' => 'Elaborato',
        'has_error' => 'Ha Errore',
        'error' => 'Errore',
        'processing_time' => 'Tempo di Elaborazione',
        'created_at' => 'Creato il',
        'updated_at' => 'Aggiornato il',
    ],

    'status' => [
        'yes' => 'Sì',
        'no' => 'No',
    ],
];
