<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Логи Вебхуков',
    'model_label' => 'Лог Вебхука',
    'plural_model_label' => 'Логи Вебхуков',

    'sections' => [
        'webhook_info' => 'Информация о Вебхуке',
        'payload' => 'Данные',
        'error' => 'Ошибка',
    ],

    'fields' => [
        'instance' => 'Экземпляр',
        'event' => 'Событие',
        'processed' => 'Обработано',
        'has_error' => 'Есть Ошибка',
        'error' => 'Ошибка',
        'processing_time' => 'Время Обработки',
        'created_at' => 'Создано',
        'updated_at' => 'Обновлено',
    ],

    'status' => [
        'yes' => 'Да',
        'no' => 'Нет',
    ],
];
