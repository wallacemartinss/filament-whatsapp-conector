<?php

declare(strict_types=1);

return [
    'send_message' => 'Надіслати Повідомлення WhatsApp',
    'modal_heading' => 'Надіслати Повідомлення WhatsApp',
    'modal_description' => 'Надіслати повідомлення на номер WhatsApp.',
    'send' => 'Надіслати Повідомлення',

    // Form fields
    'instance' => 'Екземпляр',
    'instance_helper' => 'Виберіть екземпляр WhatsApp для надсилання повідомлення.',
    'number' => 'Номер Телефону',
    'number_helper' => 'Введіть номер телефону з кодом країни (наприклад, 380501234567).',
    'type' => 'Тип Повідомлення',
    'message' => 'Повідомлення',
    'message_placeholder' => 'Введіть повідомлення тут...',
    'caption' => 'Підпис',
    'caption_placeholder' => 'Необов\'язковий підпис для медіа...',
    'media' => 'Медіафайл',
    'media_helper' => 'Завантажте файл для надсилання.',

    // Location fields
    'latitude' => 'Широта',
    'longitude' => 'Довгота',
    'location_name' => 'Назва Місця',
    'location_name_placeholder' => 'наприклад, Мій Офіс',
    'location_address' => 'Адреса',
    'location_address_placeholder' => 'наприклад, вул. Головна 123, Місто',

    // Contact fields
    'contact_name' => 'Ім\'я Контакту',
    'contact_number' => 'Телефон Контакту',

    // Notifications
    'success_title' => 'Повідомлення Надіслано!',
    'success_body' => 'Ваше повідомлення WhatsApp успішно надіслано.',
    'error_title' => 'Помилка Надсилання',
    'missing_required_fields' => 'ID екземпляра та номер телефону обов\'язкові.',
    'unsupported_type' => 'Непідтримуваний тип повідомлення.',
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
