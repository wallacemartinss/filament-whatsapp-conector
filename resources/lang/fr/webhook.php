<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Journaux Webhook',
    'model_label' => 'Journal Webhook',
    'plural_model_label' => 'Journaux Webhook',

    'sections' => [
        'webhook_info' => 'Informations du Webhook',
        'payload' => 'Charge Utile',
        'error' => 'Erreur',
    ],

    'fields' => [
        'instance' => 'Instance',
        'event' => 'Événement',
        'processed' => 'Traité',
        'has_error' => 'A une Erreur',
        'error' => 'Erreur',
        'processing_time' => 'Temps de Traitement',
        'created_at' => 'Créé le',
        'updated_at' => 'Mis à jour le',
    ],

    'status' => [
        'yes' => 'Oui',
        'no' => 'Non',
    ],
];
