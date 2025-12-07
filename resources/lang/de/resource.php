<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Instanzen',
    'navigation_group' => 'WhatsApp',
    'model_label' => 'Instanz',
    'plural_model_label' => 'Instanzen',

    'sections' => [
        'instance_info' => 'Instanzinformationen',
        'settings' => 'Einstellungen',
        'connection' => 'Verbindung',
    ],

    'fields' => [
        'name' => 'Instanzname',
        'name_helper' => 'Ein eindeutiger Name zur Identifizierung dieser Instanz',
        'number' => 'Telefonnummer',
        'number_helper' => 'Die WhatsApp-Telefonnummer mit Ländervorwahl',
        'status' => 'Status',
        'profile_picture' => 'Profilbild',
        'reject_call' => 'Anrufe ablehnen',
        'reject_call_helper' => 'Eingehende Anrufe automatisch ablehnen',
        'msg_call' => 'Ablehnungsnachricht',
        'msg_call_helper' => 'Nachricht, die beim Ablehnen eines Anrufs gesendet wird',
        'groups_ignore' => 'Gruppen ignorieren',
        'groups_ignore_helper' => 'Nachrichten aus Gruppen nicht verarbeiten',
        'always_online' => 'Immer online',
        'always_online_helper' => 'Status als online halten',
        'read_messages' => 'Nachrichten lesen',
        'read_messages_helper' => 'Nachrichten automatisch als gelesen markieren',
        'read_status' => 'Status lesen',
        'read_status_helper' => 'Statusaktualisierungen automatisch anzeigen',
        'sync_full_history' => 'Vollständigen Verlauf synchronisieren',
        'sync_full_history_helper' => 'Gesamten Nachrichtenverlauf bei Verbindung synchronisieren',
        'created_at' => 'Erstellt am',
        'updated_at' => 'Aktualisiert am',
    ],

    'actions' => [
        'connect' => 'Verbinden',
        'disconnect' => 'Trennen',
        'delete' => 'Löschen',
        'refresh' => 'Aktualisieren',
        'view_qrcode' => 'QR-Code anzeigen',
        'close' => 'Schließen',
        'back' => 'Zurück zur Liste',
    ],

    'messages' => [
        'created' => 'Instanz erfolgreich erstellt',
        'updated' => 'Instanz erfolgreich aktualisiert',
        'deleted' => 'Instanz erfolgreich gelöscht',
        'connected' => 'Instanz erfolgreich verbunden',
        'disconnected' => 'Instanz erfolgreich getrennt',
        'connection_failed' => 'Verbindung zur Instanz fehlgeschlagen',
    ],
];
