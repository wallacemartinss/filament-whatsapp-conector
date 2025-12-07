<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Webhookログ',
    'model_label' => 'Webhookログ',
    'plural_model_label' => 'Webhookログ',

    'sections' => [
        'webhook_info' => 'Webhook情報',
        'payload' => 'ペイロード',
        'error' => 'エラー',
    ],

    'fields' => [
        'instance' => 'インスタンス',
        'event' => 'イベント',
        'processed' => '処理済み',
        'has_error' => 'エラーあり',
        'error' => 'エラー',
        'processing_time' => '処理時間',
        'created_at' => '作成日時',
        'updated_at' => '更新日時',
    ],

    'status' => [
        'yes' => 'はい',
        'no' => 'いいえ',
    ],
];
