<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Webhook Logs',
    'model_label' => 'Webhook Log',
    'plural_model_label' => 'Webhook Logs',

    'sections' => [
        'webhook_info' => 'Webhook Informatie',
        'payload' => 'Payload',
        'error' => 'Fout',
    ],

    'fields' => [
        'instance' => 'Instantie',
        'event' => 'Gebeurtenis',
        'processed' => 'Verwerkt',
        'has_error' => 'Heeft Fout',
        'error' => 'Fout',
        'processing_time' => 'Verwerkingstijd',
        'created_at' => 'Aangemaakt op',
        'updated_at' => 'Bijgewerkt op',
    ],

    'status' => [
        'yes' => 'Ja',
        'no' => 'Nee',
    ],
];
