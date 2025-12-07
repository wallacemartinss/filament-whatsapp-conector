<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Instances',
    'navigation_group' => 'WhatsApp',
    'model_label' => 'Instance',
    'plural_model_label' => 'Instances',

    'sections' => [
        'instance_info' => 'Informations de l\'Instance',
        'settings' => 'Paramètres',
        'connection' => 'Connexion',
    ],

    'fields' => [
        'name' => 'Nom de l\'Instance',
        'name_helper' => 'Un nom unique pour identifier cette instance',
        'number' => 'Numéro de Téléphone',
        'number_helper' => 'Le numéro de téléphone WhatsApp avec l\'indicatif du pays',
        'status' => 'Statut',
        'profile_picture' => 'Photo de Profil',
        'reject_call' => 'Rejeter les Appels',
        'reject_call_helper' => 'Rejeter automatiquement les appels entrants',
        'msg_call' => 'Message de Rejet',
        'msg_call_helper' => 'Message envoyé lors du rejet d\'un appel',
        'groups_ignore' => 'Ignorer les Groupes',
        'groups_ignore_helper' => 'Ne pas traiter les messages des groupes',
        'always_online' => 'Toujours en Ligne',
        'always_online_helper' => 'Garder le statut comme en ligne',
        'read_messages' => 'Lire les Messages',
        'read_messages_helper' => 'Marquer automatiquement les messages comme lus',
        'read_status' => 'Lire le Statut',
        'read_status_helper' => 'Voir automatiquement les mises à jour de statut',
        'sync_full_history' => 'Synchroniser l\'Historique Complet',
        'sync_full_history_helper' => 'Synchroniser tout l\'historique des messages lors de la connexion',
        'created_at' => 'Créé le',
        'updated_at' => 'Mis à jour le',
    ],

    'actions' => [
        'connect' => 'Connecter',
        'disconnect' => 'Déconnecter',
        'delete' => 'Supprimer',
        'refresh' => 'Actualiser',
        'view_qrcode' => 'Voir le Code QR',
        'close' => 'Fermer',
        'back' => 'Retour à la Liste',
    ],

    'messages' => [
        'created' => 'Instance créée avec succès',
        'updated' => 'Instance mise à jour avec succès',
        'deleted' => 'Instance supprimée avec succès',
        'connected' => 'Instance connectée avec succès',
        'disconnected' => 'Instance déconnectée avec succès',
        'connection_failed' => 'Échec de la connexion de l\'instance',
    ],
];
