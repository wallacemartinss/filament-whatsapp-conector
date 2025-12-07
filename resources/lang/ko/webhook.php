<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Webhook 로그',
    'model_label' => 'Webhook 로그',
    'plural_model_label' => 'Webhook 로그',

    'sections' => [
        'webhook_info' => 'Webhook 정보',
        'payload' => '페이로드',
        'error' => '오류',
    ],

    'fields' => [
        'instance' => '인스턴스',
        'event' => '이벤트',
        'processed' => '처리됨',
        'has_error' => '오류 있음',
        'error' => '오류',
        'processing_time' => '처리 시간',
        'created_at' => '생성일',
        'updated_at' => '수정일',
    ],

    'status' => [
        'yes' => '예',
        'no' => '아니오',
    ],
];
