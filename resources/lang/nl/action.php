<?php

declare(strict_types=1);

return [
    'send_message' => 'WhatsApp Bericht Versturen',
    'modal_heading' => 'WhatsApp Bericht Versturen',
    'modal_description' => 'Stuur een bericht naar een WhatsApp nummer.',
    'send' => 'Bericht Versturen',

    // Form fields
    'instance' => 'Instantie',
    'instance_helper' => 'Selecteer de WhatsApp instantie om het bericht vanaf te versturen.',
    'number' => 'Telefoonnummer',
    'number_helper' => 'Voer het telefoonnummer met landcode in (bijv. 31612345678).',
    'type' => 'Berichttype',
    'message' => 'Bericht',
    'message_placeholder' => 'Typ hier uw bericht...',
    'caption' => 'Onderschrift',
    'caption_placeholder' => 'Optioneel onderschrift voor de media...',
    'media' => 'Mediabestand',
    'media_helper' => 'Upload het te versturen bestand.',

    // Location fields
    'latitude' => 'Breedtegraad',
    'longitude' => 'Lengtegraad',
    'location_name' => 'Locatienaam',
    'location_name_placeholder' => 'bijv. Mijn Kantoor',
    'location_address' => 'Adres',
    'location_address_placeholder' => 'bijv. Hoofdstraat 123, Stad',

    // Contact fields
    'contact_name' => 'Contactnaam',
    'contact_number' => 'Contacttelefoon',

    // Notifications
    'success_title' => 'Bericht Verzonden!',
    'success_body' => 'Uw WhatsApp bericht is succesvol verzonden.',
    'error_title' => 'Verzenden Mislukt',
    'missing_required_fields' => 'Instantie ID en telefoonnummer zijn verplicht.',
    'unsupported_type' => 'Niet-ondersteund berichttype.',
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
