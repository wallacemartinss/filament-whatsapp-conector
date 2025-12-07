<?php

declare(strict_types=1);

return [
    'status_connection' => [
        'open' => 'Połączony',
        'connecting' => 'Łączenie',
        'close' => 'Rozłączony',
        'refused' => 'Odrzucony',
    ],

    'message_type' => [
        'text' => 'Tekst',
        'image' => 'Obraz',
        'audio' => 'Audio',
        'video' => 'Wideo',
        'document' => 'Dokument',
        'location' => 'Lokalizacja',
        'contact' => 'Kontakt',
        'sticker' => 'Naklejka',
    ],

    'message_direction' => [
        'incoming' => 'Przychodzące',
        'outgoing' => 'Wychodzące',
    ],

    'message_status' => [
        'pending' => 'Oczekujące',
        'sent' => 'Wysłane',
        'delivered' => 'Dostarczone',
        'read' => 'Przeczytane',
        'failed' => 'Nieudane',
    ],

    'webhook_event' => [
        'application_startup' => 'Uruchomienie Aplikacji',
        'qrcode_updated' => 'Kod QR Zaktualizowany',
        'connection_update' => 'Aktualizacja Połączenia',
        'messages_set' => 'Wiadomości Ustawione',
        'messages_upsert' => 'Wiadomość Odebrana',
        'messages_update' => 'Wiadomość Zaktualizowana',
        'messages_delete' => 'Wiadomość Usunięta',
        'send_message' => 'Wiadomość Wysłana',
        'presence_update' => 'Aktualizacja Obecności',
        'new_token' => 'Nowy Token',
        'logout_instance' => 'Wylogowanie Instancji',
        'remove_instance' => 'Instancja Usunięta',
    ],
];
