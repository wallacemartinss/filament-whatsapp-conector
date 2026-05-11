<?php

declare(strict_types=1);

return [
    'send_message' => 'Wyślij Wiadomość WhatsApp',
    'modal_heading' => 'Wyślij Wiadomość WhatsApp',
    'modal_description' => 'Wyślij wiadomość na numer WhatsApp.',
    'send' => 'Wyślij Wiadomość',

    // Form fields
    'instance' => 'Instancja',
    'instance_helper' => 'Wybierz instancję WhatsApp do wysłania wiadomości.',
    'number' => 'Numer Telefonu',
    'number_helper' => 'Wprowadź numer telefonu z kodem kraju (np. 48123456789).',
    'type' => 'Typ Wiadomości',
    'message' => 'Wiadomość',
    'message_placeholder' => 'Wpisz tutaj swoją wiadomość...',
    'caption' => 'Podpis',
    'caption_placeholder' => 'Opcjonalny podpis dla mediów...',
    'media' => 'Plik Multimedialny',
    'media_helper' => 'Prześlij plik do wysłania.',

    // Location fields
    'latitude' => 'Szerokość Geograficzna',
    'longitude' => 'Długość Geograficzna',
    'location_name' => 'Nazwa Lokalizacji',
    'location_name_placeholder' => 'np. Moje Biuro',
    'location_address' => 'Adres',
    'location_address_placeholder' => 'np. ul. Główna 123, Miasto',

    // Contact fields
    'contact_name' => 'Nazwa Kontaktu',
    'contact_number' => 'Telefon Kontaktu',

    // Notifications
    'success_title' => 'Wiadomość Wysłana!',
    'success_body' => 'Twoja wiadomość WhatsApp została wysłana pomyślnie.',
    'error_title' => 'Wysyłanie Nie Powiodło Się',
    'missing_required_fields' => 'ID instancji i numer telefonu są wymagane.',
    'unsupported_type' => 'Nieobsługiwany typ wiadomości.',
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
