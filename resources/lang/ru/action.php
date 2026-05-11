<?php

declare(strict_types=1);

return [
    'send_message' => 'Отправить Сообщение WhatsApp',
    'modal_heading' => 'Отправить Сообщение WhatsApp',
    'modal_description' => 'Отправить сообщение на номер WhatsApp.',
    'send' => 'Отправить Сообщение',

    // Form fields
    'instance' => 'Экземпляр',
    'instance_helper' => 'Выберите экземпляр WhatsApp для отправки сообщения.',
    'number' => 'Номер Телефона',
    'number_helper' => 'Введите номер телефона с кодом страны (например, 79123456789).',
    'type' => 'Тип Сообщения',
    'message' => 'Сообщение',
    'message_placeholder' => 'Введите сообщение здесь...',
    'caption' => 'Подпись',
    'caption_placeholder' => 'Необязательная подпись для медиа...',
    'media' => 'Медиафайл',
    'media_helper' => 'Загрузите файл для отправки.',

    // Location fields
    'latitude' => 'Широта',
    'longitude' => 'Долгота',
    'location_name' => 'Название Места',
    'location_name_placeholder' => 'например, Мой Офис',
    'location_address' => 'Адрес',
    'location_address_placeholder' => 'например, ул. Главная 123, Город',

    // Contact fields
    'contact_name' => 'Имя Контакта',
    'contact_number' => 'Телефон Контакта',

    // Notifications
    'success_title' => 'Сообщение Отправлено!',
    'success_body' => 'Ваше сообщение WhatsApp успешно отправлено.',
    'error_title' => 'Ошибка Отправки',
    'missing_required_fields' => 'ID экземпляра и номер телефона обязательны.',
    'unsupported_type' => 'Неподдерживаемый тип сообщения.',
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
