<?php

declare(strict_types=1);

return [
    'send_message' => 'WhatsApp Mesajı Gönder',
    'modal_heading' => 'WhatsApp Mesajı Gönder',
    'modal_description' => 'Bir WhatsApp numarasına mesaj gönderin.',
    'send' => 'Mesaj Gönder',

    // Form fields
    'instance' => 'Örnek',
    'instance_helper' => 'Mesaj göndermek için WhatsApp örneğini seçin.',
    'number' => 'Telefon Numarası',
    'number_helper' => 'Ülke kodu ile telefon numarasını girin (örn: 905551234567).',
    'type' => 'Mesaj Türü',
    'message' => 'Mesaj',
    'message_placeholder' => 'Mesajınızı buraya yazın...',
    'caption' => 'Başlık',
    'caption_placeholder' => 'Medya için isteğe bağlı başlık...',
    'media' => 'Medya Dosyası',
    'media_helper' => 'Gönderilecek dosyayı yükleyin.',

    // Location fields
    'latitude' => 'Enlem',
    'longitude' => 'Boylam',
    'location_name' => 'Konum Adı',
    'location_name_placeholder' => 'örn: Ofisim',
    'location_address' => 'Adres',
    'location_address_placeholder' => 'örn: Ana Cadde 123, Şehir',

    // Contact fields
    'contact_name' => 'Kişi Adı',
    'contact_number' => 'Kişi Telefonu',

    // Notifications
    'success_title' => 'Mesaj Gönderildi!',
    'success_body' => 'WhatsApp mesajınız başarıyla gönderildi.',
    'error_title' => 'Gönderme Başarısız',
    'missing_required_fields' => 'Örnek ID ve telefon numarası gereklidir.',
    'unsupported_type' => 'Desteklenmeyen mesaj türü.',
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
