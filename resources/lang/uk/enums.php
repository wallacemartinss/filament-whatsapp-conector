<?php

declare(strict_types=1);

return [
    'status_connection' => [
        'open' => 'Підключено',
        'connecting' => 'Підключення',
        'close' => 'Відключено',
        'refused' => 'Відхилено',
    ],

    'message_type' => [
        'text' => 'Текст',
        'image' => 'Зображення',
        'audio' => 'Аудіо',
        'video' => 'Відео',
        'document' => 'Документ',
        'location' => 'Місцезнаходження',
        'contact' => 'Контакт',
        'sticker' => 'Стікер',
    ],

    'message_direction' => [
        'incoming' => 'Вхідне',
        'outgoing' => 'Вихідне',
    ],

    'message_status' => [
        'pending' => 'Очікування',
        'sent' => 'Надіслано',
        'delivered' => 'Доставлено',
        'read' => 'Прочитано',
        'failed' => 'Помилка',
    ],

    'webhook_event' => [
        'application_startup' => 'Запуск Додатку',
        'qrcode_updated' => 'QR-код Оновлено',
        'connection_update' => 'Оновлення Підключення',
        'messages_set' => 'Повідомлення Встановлено',
        'messages_upsert' => 'Повідомлення Отримано',
        'messages_update' => 'Повідомлення Оновлено',
        'messages_delete' => 'Повідомлення Видалено',
        'send_message' => 'Повідомлення Надіслано',
        'presence_update' => 'Оновлення Присутності',
        'new_token' => 'Новий Токен',
        'logout_instance' => 'Вихід з Екземпляра',
        'remove_instance' => 'Екземпляр Видалено',
    ],
];
