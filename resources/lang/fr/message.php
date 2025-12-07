<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Messages',
    'model_label' => 'Message',
    'plural_model_label' => 'Messages',

    'sections' => [
        'message_info' => 'Informations du Message',
        'content' => 'Contenu',
        'timestamps' => 'Horodatages',
        'raw_payload' => 'Données Brutes',
    ],

    'fields' => [
        'instance' => 'Instance',
        'direction' => 'Direction',
        'phone' => 'Téléphone',
        'type' => 'Type',
        'content' => 'Contenu',
        'status' => 'Statut',
        'message_id' => 'ID du Message',
        'media' => 'Média',
        'media_caption' => 'Légende du Média',
        'media_url' => 'URL du Média',
        'location' => 'Localisation',
        'sent_at' => 'Envoyé le',
        'delivered_at' => 'Livré le',
        'read_at' => 'Lu le',
        'created_at' => 'Créé le',
    ],
];
