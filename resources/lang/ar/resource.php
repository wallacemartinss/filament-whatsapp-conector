<?php

declare(strict_types=1);

return [
    'navigation_label' => 'المثيلات',
    'navigation_group' => 'واتساب',
    'model_label' => 'مثيل',
    'plural_model_label' => 'المثيلات',

    'sections' => [
        'instance_info' => 'معلومات المثيل',
        'settings' => 'الإعدادات',
        'connection' => 'الاتصال',
    ],

    'fields' => [
        'name' => 'اسم المثيل',
        'name_helper' => 'اسم فريد لتحديد هذا المثيل',
        'number' => 'رقم الهاتف',
        'number_helper' => 'رقم هاتف واتساب مع رمز البلد',
        'status' => 'الحالة',
        'profile_picture' => 'صورة الملف الشخصي',
        'reject_call' => 'رفض المكالمات',
        'reject_call_helper' => 'رفض المكالمات الواردة تلقائيًا',
        'msg_call' => 'رسالة الرفض',
        'msg_call_helper' => 'الرسالة المرسلة عند رفض المكالمة',
        'groups_ignore' => 'تجاهل المجموعات',
        'groups_ignore_helper' => 'عدم معالجة الرسائل من المجموعات',
        'always_online' => 'متصل دائمًا',
        'always_online_helper' => 'إبقاء الحالة كمتصل',
        'read_messages' => 'قراءة الرسائل',
        'read_messages_helper' => 'وضع علامة مقروء على الرسائل تلقائيًا',
        'read_status' => 'قراءة الحالة',
        'read_status_helper' => 'عرض تحديثات الحالة تلقائيًا',
        'sync_full_history' => 'مزامنة السجل الكامل',
        'sync_full_history_helper' => 'مزامنة جميع سجل الرسائل عند الاتصال',
        'created_at' => 'تاريخ الإنشاء',
        'updated_at' => 'تاريخ التحديث',
    ],

    'actions' => [
        'connect' => 'اتصال',
        'disconnect' => 'قطع الاتصال',
        'delete' => 'حذف',
        'refresh' => 'تحديث',
        'view_qrcode' => 'عرض رمز QR',
        'close' => 'إغلاق',
        'back' => 'العودة للقائمة',
    ],

    'messages' => [
        'created' => 'تم إنشاء المثيل بنجاح',
        'updated' => 'تم تحديث المثيل بنجاح',
        'deleted' => 'تم حذف المثيل بنجاح',
        'connected' => 'تم الاتصال بالمثيل بنجاح',
        'disconnected' => 'تم قطع اتصال المثيل بنجاح',
        'connection_failed' => 'فشل الاتصال بالمثيل',
    ],
];
