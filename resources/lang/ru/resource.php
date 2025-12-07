<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Экземпляры',
    'navigation_group' => 'WhatsApp',
    'model_label' => 'Экземпляр',
    'plural_model_label' => 'Экземпляры',

    'sections' => [
        'instance_info' => 'Информация об Экземпляре',
        'settings' => 'Настройки',
        'connection' => 'Подключение',
    ],

    'fields' => [
        'name' => 'Имя Экземпляра',
        'name_helper' => 'Уникальное имя для идентификации этого экземпляра',
        'number' => 'Номер Телефона',
        'number_helper' => 'Номер телефона WhatsApp с кодом страны',
        'status' => 'Статус',
        'profile_picture' => 'Фото Профиля',
        'reject_call' => 'Отклонять Звонки',
        'reject_call_helper' => 'Автоматически отклонять входящие звонки',
        'msg_call' => 'Сообщение Отклонения',
        'msg_call_helper' => 'Сообщение, отправляемое при отклонении звонка',
        'groups_ignore' => 'Игнорировать Группы',
        'groups_ignore_helper' => 'Не обрабатывать сообщения из групп',
        'always_online' => 'Всегда Онлайн',
        'always_online_helper' => 'Держать статус онлайн',
        'read_messages' => 'Читать Сообщения',
        'read_messages_helper' => 'Автоматически отмечать сообщения как прочитанные',
        'read_status' => 'Читать Статус',
        'read_status_helper' => 'Автоматически просматривать обновления статуса',
        'sync_full_history' => 'Синхронизировать Полную Историю',
        'sync_full_history_helper' => 'Синхронизировать всю историю сообщений при подключении',
        'created_at' => 'Создано',
        'updated_at' => 'Обновлено',
    ],

    'actions' => [
        'connect' => 'Подключить',
        'disconnect' => 'Отключить',
        'delete' => 'Удалить',
        'refresh' => 'Обновить',
        'view_qrcode' => 'Показать QR-код',
        'close' => 'Закрыть',
        'back' => 'Вернуться к Списку',
    ],

    'messages' => [
        'created' => 'Экземпляр успешно создан',
        'updated' => 'Экземпляр успешно обновлен',
        'deleted' => 'Экземпляр успешно удален',
        'connected' => 'Экземпляр успешно подключен',
        'disconnected' => 'Экземпляр успешно отключен',
        'connection_failed' => 'Не удалось подключить экземпляр',
    ],
];
