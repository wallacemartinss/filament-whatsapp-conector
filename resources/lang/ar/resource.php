<?php

declare(strict_types=1);

return [
    'navigation_label' => 'الحسابات',
    'navigation_group' => 'واتساب',
    'model_label' => 'حساب',
    'plural_model_label' => 'الحسابات',

    'sections' => [
        'instance_info' => 'معلومات الحساب',
        'settings' => 'الإعدادات',
        'connection' => 'الاتصال',
    ],

    'fields' => [
        'name' => 'اسم الحساب',
        'name_helper' => 'اسم فريد لتحديد هذا الحساب',
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
        'delete_confirmation' => 'سيؤدي هذا الإجراء إلى نقل الحساب إلى سلة المهملات. يمكنك استعادته لاحقًا.',
        'force_delete_confirmation' => 'سيؤدي هذا الإجراء إلى حذف الحساب نهائيًا من النظام وواجهة Evolution API. لا يمكن التراجع عن هذا الإجراء.',
        'refresh' => 'تحديث',
        'view_qrcode' => 'عرض رمز QR',
        'close' => 'إغلاق',
        'back' => 'العودة للقائمة',
    ],

    'messages' => [
        'created' => 'تم إنشاء الحساب بنجاح',
        'updated' => 'تم تحديث الحساب بنجاح',
        'deleted' => 'تم حذف الحساب بنجاح',
        'connected' => 'تم ربط الحساب بنجاح',
        'disconnected' => 'تم قطع اتصال الحساب بنجاح',
        'connection_failed' => 'فشل ربط الحساب',
        'api_created' => 'تم إنشاء الحساب في Evolution API',
        'api_sync_failed' => 'تم حفظ الحساب محليًا. فشلت المزامنة مع API:',
        'api_create_failed' => 'فشل إنشاء الحساب',
    ],
];
