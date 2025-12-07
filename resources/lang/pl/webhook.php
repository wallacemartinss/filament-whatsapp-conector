<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Logi Webhook',
    'model_label' => 'Log Webhook',
    'plural_model_label' => 'Logi Webhook',

    'sections' => [
        'webhook_info' => 'Informacje o Webhook',
        'payload' => 'Ładunek',
        'error' => 'Błąd',
    ],

    'fields' => [
        'instance' => 'Instancja',
        'event' => 'Zdarzenie',
        'processed' => 'Przetworzono',
        'has_error' => 'Ma Błąd',
        'error' => 'Błąd',
        'processing_time' => 'Czas Przetwarzania',
        'created_at' => 'Utworzono',
        'updated_at' => 'Zaktualizowano',
    ],

    'status' => [
        'yes' => 'Tak',
        'no' => 'Nie',
    ],
];
