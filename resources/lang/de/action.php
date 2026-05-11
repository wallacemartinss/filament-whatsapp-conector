<?php

declare(strict_types=1);

return [
    'send_message' => 'WhatsApp-Nachricht senden',
    'modal_heading' => 'WhatsApp-Nachricht senden',
    'modal_description' => 'Senden Sie eine Nachricht an eine WhatsApp-Nummer.',
    'send' => 'Nachricht senden',

    // Form fields
    'instance' => 'Instanz',
    'instance_helper' => 'Wählen Sie die WhatsApp-Instanz zum Senden der Nachricht.',
    'number' => 'Telefonnummer',
    'number_helper' => 'Geben Sie die Telefonnummer mit Ländervorwahl ein (z.B. 4915123456789).',
    'type' => 'Nachrichtentyp',
    'message' => 'Nachricht',
    'message_placeholder' => 'Geben Sie hier Ihre Nachricht ein...',
    'caption' => 'Beschriftung',
    'caption_placeholder' => 'Optionale Beschriftung für die Medien...',
    'media' => 'Mediendatei',
    'media_helper' => 'Laden Sie die zu sendende Datei hoch.',

    // Location fields
    'latitude' => 'Breitengrad',
    'longitude' => 'Längengrad',
    'location_name' => 'Ortsname',
    'location_name_placeholder' => 'z.B. Mein Büro',
    'location_address' => 'Adresse',
    'location_address_placeholder' => 'z.B. Hauptstraße 123, Stadt',

    // Contact fields
    'contact_name' => 'Kontaktname',
    'contact_number' => 'Kontakttelefon',

    // Notifications
    'success_title' => 'Nachricht gesendet!',
    'success_body' => 'Ihre WhatsApp-Nachricht wurde erfolgreich gesendet.',
    'error_title' => 'Senden fehlgeschlagen',
    'missing_required_fields' => 'Instanz-ID und Telefonnummer sind erforderlich.',
    'unsupported_type' => 'Nicht unterstützter Nachrichtentyp.',
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
