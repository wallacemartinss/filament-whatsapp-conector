<?php

declare(strict_types=1);

return [
    'status_connection' => [
        'open' => 'Подключен',
        'connecting' => 'Подключение',
        'close' => 'Отключен',
        'refused' => 'Отклонен',
    ],

    'message_type' => [
        'text' => 'Текст',
        'image' => 'Изображение',
        'audio' => 'Аудио',
        'video' => 'Видео',
        'document' => 'Документ',
        'location' => 'Местоположение',
        'contact' => 'Контакт',
        'sticker' => 'Стикер',
    ],

    'message_direction' => [
        'incoming' => 'Входящее',
        'outgoing' => 'Исходящее',
    ],

    'message_status' => [
        'pending' => 'Ожидание',
        'sent' => 'Отправлено',
        'delivered' => 'Доставлено',
        'read' => 'Прочитано',
        'failed' => 'Ошибка',
    ],

    'webhook_event' => [
        'application_startup' => 'Запуск Приложения',
        'qrcode_updated' => 'QR-код Обновлен',
        'connection_update' => 'Обновление Подключения',
        'messages_set' => 'Сообщения Установлены',
        'messages_upsert' => 'Сообщение Получено',
        'messages_update' => 'Сообщение Обновлено',
        'messages_delete' => 'Сообщение Удалено',
        'send_message' => 'Сообщение Отправлено',
        'presence_update' => 'Обновление Присутствия',
        'new_token' => 'Новый Токен',
        'logout_instance' => 'Выход из Экземпляра',
        'remove_instance' => 'Экземпляр Удален',
    ],
];
