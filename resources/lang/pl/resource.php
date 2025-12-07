<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Instancje',
    'navigation_group' => 'WhatsApp',
    'model_label' => 'Instancja',
    'plural_model_label' => 'Instancje',

    'sections' => [
        'instance_info' => 'Informacje o Instancji',
        'settings' => 'Ustawienia',
        'connection' => 'Połączenie',
    ],

    'fields' => [
        'name' => 'Nazwa Instancji',
        'name_helper' => 'Unikalna nazwa identyfikująca tę instancję',
        'number' => 'Numer Telefonu',
        'number_helper' => 'Numer telefonu WhatsApp z kodem kraju',
        'status' => 'Status',
        'profile_picture' => 'Zdjęcie Profilowe',
        'reject_call' => 'Odrzucaj Połączenia',
        'reject_call_helper' => 'Automatycznie odrzucaj połączenia przychodzące',
        'msg_call' => 'Wiadomość Odrzucenia',
        'msg_call_helper' => 'Wiadomość wysyłana przy odrzucaniu połączenia',
        'groups_ignore' => 'Ignoruj Grupy',
        'groups_ignore_helper' => 'Nie przetwarzaj wiadomości z grup',
        'always_online' => 'Zawsze Online',
        'always_online_helper' => 'Utrzymuj status jako online',
        'read_messages' => 'Czytaj Wiadomości',
        'read_messages_helper' => 'Automatycznie oznaczaj wiadomości jako przeczytane',
        'read_status' => 'Czytaj Status',
        'read_status_helper' => 'Automatycznie wyświetlaj aktualizacje statusu',
        'sync_full_history' => 'Synchronizuj Pełną Historię',
        'sync_full_history_helper' => 'Synchronizuj całą historię wiadomości przy połączeniu',
        'created_at' => 'Utworzono',
        'updated_at' => 'Zaktualizowano',
    ],

    'actions' => [
        'connect' => 'Połącz',
        'disconnect' => 'Rozłącz',
        'delete' => 'Usuń',
        'refresh' => 'Odśwież',
        'view_qrcode' => 'Zobacz Kod QR',
        'close' => 'Zamknij',
        'back' => 'Wróć do Listy',
    ],

    'messages' => [
        'created' => 'Instancja utworzona pomyślnie',
        'updated' => 'Instancja zaktualizowana pomyślnie',
        'deleted' => 'Instancja usunięta pomyślnie',
        'connected' => 'Instancja połączona pomyślnie',
        'disconnected' => 'Instancja rozłączona pomyślnie',
        'connection_failed' => 'Nie udało się połączyć z instancją',
    ],
];
