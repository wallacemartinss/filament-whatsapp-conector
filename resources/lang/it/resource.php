<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Istanze',
    'navigation_group' => 'WhatsApp',
    'model_label' => 'Istanza',
    'plural_model_label' => 'Istanze',

    'sections' => [
        'instance_info' => 'Informazioni Istanza',
        'settings' => 'Impostazioni',
        'connection' => 'Connessione',
    ],

    'fields' => [
        'name' => 'Nome Istanza',
        'name_helper' => 'Un nome univoco per identificare questa istanza',
        'number' => 'Numero di Telefono',
        'number_helper' => 'Il numero di telefono WhatsApp con prefisso internazionale',
        'status' => 'Stato',
        'profile_picture' => 'Foto Profilo',
        'reject_call' => 'Rifiuta Chiamate',
        'reject_call_helper' => 'Rifiuta automaticamente le chiamate in arrivo',
        'msg_call' => 'Messaggio di Rifiuto',
        'msg_call_helper' => 'Messaggio inviato quando si rifiuta una chiamata',
        'groups_ignore' => 'Ignora Gruppi',
        'groups_ignore_helper' => 'Non elaborare messaggi dai gruppi',
        'always_online' => 'Sempre Online',
        'always_online_helper' => 'Mantieni lo stato come online',
        'read_messages' => 'Leggi Messaggi',
        'read_messages_helper' => 'Segna automaticamente i messaggi come letti',
        'read_status' => 'Leggi Stato',
        'read_status_helper' => 'Visualizza automaticamente gli aggiornamenti di stato',
        'sync_full_history' => 'Sincronizza Cronologia Completa',
        'sync_full_history_helper' => 'Sincronizza tutta la cronologia messaggi alla connessione',
        'created_at' => 'Creato il',
        'updated_at' => 'Aggiornato il',
    ],

    'actions' => [
        'connect' => 'Connetti',
        'disconnect' => 'Disconnetti',
        'delete' => 'Elimina',
        'refresh' => 'Aggiorna',
        'view_qrcode' => 'Visualizza Codice QR',
        'close' => 'Chiudi',
        'back' => 'Torna alla Lista',
    ],

    'messages' => [
        'created' => 'Istanza creata con successo',
        'updated' => 'Istanza aggiornata con successo',
        'deleted' => 'Istanza eliminata con successo',
        'connected' => 'Istanza connessa con successo',
        'disconnected' => 'Istanza disconnessa con successo',
        'connection_failed' => 'Connessione istanza fallita',
    ],
];
