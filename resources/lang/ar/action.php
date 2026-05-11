<?php

declare(strict_types=1);

return [
    'send_message' => 'إرسال رسالة واتساب',
    'modal_heading' => 'إرسال رسالة واتساب',
    'modal_description' => 'إرسال رسالة إلى رقم واتساب.',
    'send' => 'إرسال الرسالة',

    // Form fields
    'instance' => 'المثيل',
    'instance_helper' => 'اختر مثيل واتساب لإرسال الرسالة منه.',
    'number' => 'رقم الهاتف',
    'number_helper' => 'أدخل رقم الهاتف مع رمز البلد (مثال: 5511999999999).',
    'type' => 'نوع الرسالة',
    'message' => 'الرسالة',
    'message_placeholder' => 'اكتب رسالتك هنا...',
    'caption' => 'التعليق',
    'caption_placeholder' => 'تعليق اختياري للوسائط...',
    'media' => 'ملف الوسائط',
    'media_helper' => 'قم بتحميل الملف المراد إرساله.',

    // Location fields
    'latitude' => 'خط العرض',
    'longitude' => 'خط الطول',
    'location_name' => 'اسم الموقع',
    'location_name_placeholder' => 'مثال: مكتبي',
    'location_address' => 'العنوان',
    'location_address_placeholder' => 'مثال: 123 الشارع الرئيسي، المدينة',

    // Contact fields
    'contact_name' => 'اسم جهة الاتصال',
    'contact_number' => 'هاتف جهة الاتصال',

    // Notifications
    'success_title' => 'تم إرسال الرسالة!',
    'success_body' => 'تم إرسال رسالة واتساب الخاصة بك بنجاح.',
    'error_title' => 'فشل الإرسال',
    'missing_required_fields' => 'معرف المثيل ورقم الهاتف مطلوبان.',
    'unsupported_type' => 'نوع رسالة غير مدعوم.',
    // Interactive (Buttons / CTA / PIX shared)
    'interactive_section' => 'Message Content',
    'interactive_description' => 'Body',
    'interactive_title' => 'Title',
    'interactive_footer' => 'Footer',

    // Reply buttons
    'reply_buttons' => 'Buttons (max 3)',
    'button_text' => 'Button Text',
    'button_id' => 'Button ID',

    // CTA buttons
    'cta_buttons' => 'CTA Buttons (max 2)',
    'cta_buttons_helper' => 'CTA buttons cannot be mixed with reply or PIX buttons.',
    'button_type' => 'Type',
    'button_type_reply' => 'Reply',
    'button_type_url' => 'URL',
    'button_type_call' => 'Call',
    'button_type_copy' => 'Copy',
    'button_value' => 'Value',
    'button_value_helper' => 'URL, phone number or text to copy depending on the button type.',

    // PIX
    'pix_section' => 'PIX',
    'pix_key' => 'PIX Key',
    'pix_key_type' => 'Key Type',
    'pix_key_random' => 'Random',
    'pix_name' => 'Receiver Name',
    'pix_currency' => 'Currency',
    'pix_amount' => 'Amount',
    'pix_amount_helper' => 'Optional. Leave blank to let the recipient type the amount.',

    // List
    'list_section' => 'List',
    'list_title' => 'List Title',
    'list_description' => 'Description',
    'list_button_text' => 'Button Label',
    'list_button_text_placeholder' => 'View options',
    'list_footer' => 'Footer',
    'list_sections' => 'Sections',
    'list_section_title' => 'Section Title',
    'list_section_rows' => 'Rows',
    'list_row_title' => 'Row Title',
    'list_row_id' => 'Row ID',
    'list_row_description' => 'Row Description',

    // Carousel
    'carousel_section' => 'Carousel',
    'carousel_message' => 'Message',
    'carousel_cards' => 'Cards',
    'carousel_image_url' => 'Image URL',
    'carousel_image_helper' => 'Optional. Single-card-without-image falls back to native flow for iOS compatibility.',
    'carousel_header' => 'Header',
    'carousel_footer' => 'Footer',
    'carousel_body' => 'Body',
    'carousel_buttons' => 'Card Buttons',

];
