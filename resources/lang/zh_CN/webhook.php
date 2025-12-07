<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Webhook日志',
    'model_label' => 'Webhook日志',
    'plural_model_label' => 'Webhook日志',

    'sections' => [
        'webhook_info' => 'Webhook信息',
        'payload' => '负载',
        'error' => '错误',
    ],

    'fields' => [
        'instance' => '实例',
        'event' => '事件',
        'processed' => '已处理',
        'has_error' => '有错误',
        'error' => '错误',
        'processing_time' => '处理时间',
        'created_at' => '创建时间',
        'updated_at' => '更新时间',
    ],

    'status' => [
        'yes' => '是',
        'no' => '否',
    ],
];
