<?php

declare(strict_types=1);

return [
    'send_message' => '发送WhatsApp消息',
    'modal_heading' => '发送WhatsApp消息',
    'modal_description' => '向WhatsApp号码发送消息。',
    'send' => '发送消息',

    // Form fields
    'instance' => '实例',
    'instance_helper' => '选择用于发送消息的WhatsApp实例。',
    'number' => '电话号码',
    'number_helper' => '输入带国家代码的电话号码（例如：8613812345678）。',
    'type' => '消息类型',
    'message' => '消息',
    'message_placeholder' => '在此输入您的消息...',
    'caption' => '说明',
    'caption_placeholder' => '媒体的可选说明...',
    'media' => '媒体文件',
    'media_helper' => '上传要发送的文件。',

    // Location fields
    'latitude' => '纬度',
    'longitude' => '经度',
    'location_name' => '位置名称',
    'location_name_placeholder' => '例如：我的办公室',
    'location_address' => '地址',
    'location_address_placeholder' => '例如：主街123号，城市',

    // Contact fields
    'contact_name' => '联系人姓名',
    'contact_number' => '联系人电话',

    // Notifications
    'success_title' => '消息已发送！',
    'success_body' => '您的WhatsApp消息已成功发送。',
    'error_title' => '发送失败',
    'missing_required_fields' => '需要实例ID和电话号码。',
    'unsupported_type' => '不支持的消息类型。',
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
