<?php

declare(strict_types=1);

return [
    'send_message' => 'Invia Messaggio WhatsApp',
    'modal_heading' => 'Invia Messaggio WhatsApp',
    'modal_description' => 'Invia un messaggio a un numero WhatsApp.',
    'send' => 'Invia Messaggio',

    // Form fields
    'instance' => 'Istanza',
    'instance_helper' => 'Seleziona l\'istanza WhatsApp da cui inviare il messaggio.',
    'number' => 'Numero di Telefono',
    'number_helper' => 'Inserisci il numero di telefono con prefisso internazionale (es: 393331234567).',
    'type' => 'Tipo di Messaggio',
    'message' => 'Messaggio',
    'message_placeholder' => 'Scrivi il tuo messaggio qui...',
    'caption' => 'Didascalia',
    'caption_placeholder' => 'Didascalia opzionale per il media...',
    'media' => 'File Media',
    'media_helper' => 'Carica il file da inviare.',

    // Location fields
    'latitude' => 'Latitudine',
    'longitude' => 'Longitudine',
    'location_name' => 'Nome Posizione',
    'location_name_placeholder' => 'es: Il Mio Ufficio',
    'location_address' => 'Indirizzo',
    'location_address_placeholder' => 'es: Via Principale 123, Città',

    // Contact fields
    'contact_name' => 'Nome Contatto',
    'contact_number' => 'Telefono Contatto',

    // Notifications
    'success_title' => 'Messaggio Inviato!',
    'success_body' => 'Il tuo messaggio WhatsApp è stato inviato con successo.',
    'error_title' => 'Invio Fallito',
    'missing_required_fields' => 'ID istanza e numero di telefono sono obbligatori.',
    'unsupported_type' => 'Tipo di messaggio non supportato.',
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
