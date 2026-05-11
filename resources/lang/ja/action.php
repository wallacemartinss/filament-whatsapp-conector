<?php

declare(strict_types=1);

return [
    'send_message' => 'WhatsAppメッセージを送信',
    'modal_heading' => 'WhatsAppメッセージを送信',
    'modal_description' => 'WhatsApp番号にメッセージを送信します。',
    'send' => 'メッセージを送信',

    // Form fields
    'instance' => 'インスタンス',
    'instance_helper' => 'メッセージを送信するWhatsAppインスタンスを選択してください。',
    'number' => '電話番号',
    'number_helper' => '国番号付きの電話番号を入力してください（例：819012345678）。',
    'type' => 'メッセージタイプ',
    'message' => 'メッセージ',
    'message_placeholder' => 'ここにメッセージを入力...',
    'caption' => 'キャプション',
    'caption_placeholder' => 'メディアのオプションキャプション...',
    'media' => 'メディアファイル',
    'media_helper' => '送信するファイルをアップロードしてください。',

    // Location fields
    'latitude' => '緯度',
    'longitude' => '経度',
    'location_name' => '場所名',
    'location_name_placeholder' => '例：私のオフィス',
    'location_address' => '住所',
    'location_address_placeholder' => '例：東京都渋谷区1-2-3',

    // Contact fields
    'contact_name' => '連絡先名',
    'contact_number' => '連絡先電話番号',

    // Notifications
    'success_title' => 'メッセージ送信完了！',
    'success_body' => 'WhatsAppメッセージが正常に送信されました。',
    'error_title' => '送信失敗',
    'missing_required_fields' => 'インスタンスIDと電話番号は必須です。',
    'unsupported_type' => 'サポートされていないメッセージタイプです。',
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
