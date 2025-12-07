<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Instanties',
    'navigation_group' => 'WhatsApp',
    'model_label' => 'Instantie',
    'plural_model_label' => 'Instanties',

    'sections' => [
        'instance_info' => 'Instantie Informatie',
        'settings' => 'Instellingen',
        'connection' => 'Verbinding',
    ],

    'fields' => [
        'name' => 'Instantie Naam',
        'name_helper' => 'Een unieke naam om deze instantie te identificeren',
        'number' => 'Telefoonnummer',
        'number_helper' => 'Het WhatsApp telefoonnummer met landcode',
        'status' => 'Status',
        'profile_picture' => 'Profielfoto',
        'reject_call' => 'Oproepen Weigeren',
        'reject_call_helper' => 'Automatisch inkomende oproepen weigeren',
        'msg_call' => 'Weigeringsbericht',
        'msg_call_helper' => 'Bericht dat wordt verzonden bij het weigeren van een oproep',
        'groups_ignore' => 'Groepen Negeren',
        'groups_ignore_helper' => 'Berichten van groepen niet verwerken',
        'always_online' => 'Altijd Online',
        'always_online_helper' => 'Status als online houden',
        'read_messages' => 'Berichten Lezen',
        'read_messages_helper' => 'Berichten automatisch als gelezen markeren',
        'read_status' => 'Status Lezen',
        'read_status_helper' => 'Statusupdates automatisch bekijken',
        'sync_full_history' => 'Volledige Geschiedenis Synchroniseren',
        'sync_full_history_helper' => 'Alle berichtengeschiedenis synchroniseren bij verbinding',
        'created_at' => 'Aangemaakt op',
        'updated_at' => 'Bijgewerkt op',
    ],

    'actions' => [
        'connect' => 'Verbinden',
        'disconnect' => 'Verbinding Verbreken',
        'delete' => 'Verwijderen',
        'refresh' => 'Vernieuwen',
        'view_qrcode' => 'QR-code Bekijken',
        'close' => 'Sluiten',
        'back' => 'Terug naar Lijst',
    ],

    'messages' => [
        'created' => 'Instantie succesvol aangemaakt',
        'updated' => 'Instantie succesvol bijgewerkt',
        'deleted' => 'Instantie succesvol verwijderd',
        'connected' => 'Instantie succesvol verbonden',
        'disconnected' => 'Instantie succesvol losgekoppeld',
        'connection_failed' => 'Verbinding met instantie mislukt',
    ],
];
