<?php

declare(strict_types=1);

return [
    'status_connection' => [
        'open' => 'متصل',
        'connecting' => 'جاري الاتصال',
        'close' => 'غير متصل',
        'refused' => 'مرفوض',
    ],

    'message_type' => [
        'text' => 'نص',
        'image' => 'صورة',
        'audio' => 'صوت',
        'video' => 'فيديو',
        'document' => 'مستند',
        'location' => 'موقع',
        'contact' => 'جهة اتصال',
        'sticker' => 'ملصق',
    ],

    'message_direction' => [
        'incoming' => 'وارد',
        'outgoing' => 'صادر',
    ],

    'message_status' => [
        'pending' => 'قيد الانتظار',
        'sent' => 'مرسل',
        'delivered' => 'تم التسليم',
        'read' => 'مقروء',
        'failed' => 'فشل',
    ],

    'webhook_event' => [
        'application_startup' => 'بدء التطبيق',
        'qrcode_updated' => 'تم تحديث رمز QR',
        'connection_update' => 'تحديث الاتصال',
        'messages_set' => 'تعيين الرسائل',
        'messages_upsert' => 'رسالة مستلمة',
        'messages_update' => 'تحديث الرسالة',
        'messages_delete' => 'حذف الرسالة',
        'send_message' => 'رسالة مرسلة',
        'presence_update' => 'تحديث التواجد',
        'new_token' => 'رمز جديد',
        'logout_instance' => 'تسجيل خروج المثيل',
        'remove_instance' => 'إزالة المثيل',
    ],
];
