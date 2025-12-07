<?php

declare(strict_types=1);

return [
    'navigation_label' => 'سجلات Webhook',
    'model_label' => 'سجل Webhook',
    'plural_model_label' => 'سجلات Webhook',

    'sections' => [
        'webhook_info' => 'معلومات Webhook',
        'payload' => 'البيانات',
        'error' => 'الخطأ',
    ],

    'fields' => [
        'instance' => 'المثيل',
        'event' => 'الحدث',
        'processed' => 'تمت المعالجة',
        'has_error' => 'يوجد خطأ',
        'error' => 'الخطأ',
        'processing_time' => 'وقت المعالجة',
        'created_at' => 'تاريخ الإنشاء',
        'updated_at' => 'تاريخ التحديث',
    ],

    'status' => [
        'yes' => 'نعم',
        'no' => 'لا',
    ],
];
