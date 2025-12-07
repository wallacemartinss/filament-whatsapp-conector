<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Registros de Webhook',
    'model_label' => 'Registro de Webhook',
    'plural_model_label' => 'Registros de Webhook',

    'sections' => [
        'webhook_info' => 'Información del Webhook',
        'payload' => 'Carga Útil',
        'error' => 'Error',
    ],

    'fields' => [
        'instance' => 'Instancia',
        'event' => 'Evento',
        'processed' => 'Procesado',
        'has_error' => 'Tiene Error',
        'error' => 'Error',
        'processing_time' => 'Tiempo de Procesamiento',
        'created_at' => 'Creado el',
        'updated_at' => 'Actualizado el',
    ],

    'status' => [
        'yes' => 'Sí',
        'no' => 'No',
    ],
];
