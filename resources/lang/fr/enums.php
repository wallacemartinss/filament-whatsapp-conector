<?php

declare(strict_types=1);

return [
    'status_connection' => [
        'open' => 'Connecté',
        'connecting' => 'Connexion',
        'close' => 'Déconnecté',
        'refused' => 'Refusé',
    ],

    'message_type' => [
        'text' => 'Texte',
        'image' => 'Image',
        'audio' => 'Audio',
        'video' => 'Vidéo',
        'document' => 'Document',
        'location' => 'Localisation',
        'contact' => 'Contact',
        'sticker' => 'Autocollant',
    ],

    'message_direction' => [
        'incoming' => 'Entrant',
        'outgoing' => 'Sortant',
    ],

    'message_status' => [
        'pending' => 'En attente',
        'sent' => 'Envoyé',
        'delivered' => 'Livré',
        'read' => 'Lu',
        'failed' => 'Échoué',
    ],

    'webhook_event' => [
        'application_startup' => 'Démarrage de l\'Application',
        'qrcode_updated' => 'Code QR Mis à Jour',
        'connection_update' => 'Mise à Jour de Connexion',
        'messages_set' => 'Messages Définis',
        'messages_upsert' => 'Message Reçu',
        'messages_update' => 'Message Mis à Jour',
        'messages_delete' => 'Message Supprimé',
        'send_message' => 'Message Envoyé',
        'presence_update' => 'Mise à Jour de Présence',
        'new_token' => 'Nouveau Jeton',
        'logout_instance' => 'Déconnexion de l\'Instance',
        'remove_instance' => 'Instance Supprimée',
    ],
];
