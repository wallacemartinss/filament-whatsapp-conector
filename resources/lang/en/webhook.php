<?php

return [
    'navigation_label' => 'Webhook Logs',
    'model_label' => 'Webhook Log',
    'plural_model_label' => 'Webhook Logs',

    'sections' => [
        'webhook_info' => 'Webhook Information',
        'payload' => 'Payload',
        'error' => 'Error',
    ],

    'fields' => [
        'instance' => 'Instance',
        'event' => 'Event',
        'processed' => 'Processed',
        'has_error' => 'Has Error',
        'error' => 'Error',
        'processing_time' => 'Processing Time',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
    ],

    'status' => [
        'yes' => 'Yes',
        'no' => 'No',
    ],
];
