<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Екземпляри',
    'navigation_group' => 'WhatsApp',
    'model_label' => 'Екземпляр',
    'plural_model_label' => 'Екземпляри',

    'sections' => [
        'instance_info' => 'Інформація про Екземпляр',
        'settings' => 'Налаштування',
        'connection' => 'Підключення',
    ],

    'fields' => [
        'name' => 'Назва Екземпляра',
        'name_helper' => 'Унікальна назва для ідентифікації цього екземпляра',
        'number' => 'Номер Телефону',
        'number_helper' => 'Номер телефону WhatsApp з кодом країни',
        'status' => 'Статус',
        'profile_picture' => 'Фото Профілю',
        'reject_call' => 'Відхиляти Дзвінки',
        'reject_call_helper' => 'Автоматично відхиляти вхідні дзвінки',
        'msg_call' => 'Повідомлення Відхилення',
        'msg_call_helper' => 'Повідомлення, що надсилається при відхиленні дзвінка',
        'groups_ignore' => 'Ігнорувати Групи',
        'groups_ignore_helper' => 'Не обробляти повідомлення з груп',
        'always_online' => 'Завжди Онлайн',
        'always_online_helper' => 'Тримати статус онлайн',
        'read_messages' => 'Читати Повідомлення',
        'read_messages_helper' => 'Автоматично позначати повідомлення як прочитані',
        'read_status' => 'Читати Статус',
        'read_status_helper' => 'Автоматично переглядати оновлення статусу',
        'sync_full_history' => 'Синхронізувати Повну Історію',
        'sync_full_history_helper' => 'Синхронізувати всю історію повідомлень при підключенні',
        'created_at' => 'Створено',
        'updated_at' => 'Оновлено',
    ],

    'actions' => [
        'connect' => 'Підключити',
        'disconnect' => 'Відключити',
        'delete' => 'Видалити',
        'refresh' => 'Оновити',
        'view_qrcode' => 'Показати QR-код',
        'close' => 'Закрити',
        'back' => 'Повернутися до Списку',
    ],

    'messages' => [
        'created' => 'Екземпляр успішно створено',
        'updated' => 'Екземпляр успішно оновлено',
        'deleted' => 'Екземпляр успішно видалено',
        'connected' => 'Екземпляр успішно підключено',
        'disconnected' => 'Екземпляр успішно відключено',
        'connection_failed' => 'Не вдалося підключити екземпляр',
    ],
];
