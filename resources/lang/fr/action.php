<?php

declare(strict_types=1);

return [
    'send_message' => 'Envoyer un Message WhatsApp',
    'modal_heading' => 'Envoyer un Message WhatsApp',
    'modal_description' => 'Envoyer un message à un numéro WhatsApp.',
    'send' => 'Envoyer le Message',

    // Form fields
    'instance' => 'Instance',
    'instance_helper' => 'Sélectionnez l\'instance WhatsApp pour envoyer le message.',
    'number' => 'Numéro de Téléphone',
    'number_helper' => 'Entrez le numéro de téléphone avec l\'indicatif du pays (ex: 33612345678).',
    'type' => 'Type de Message',
    'message' => 'Message',
    'message_placeholder' => 'Tapez votre message ici...',
    'caption' => 'Légende',
    'caption_placeholder' => 'Légende optionnelle pour le média...',
    'media' => 'Fichier Média',
    'media_helper' => 'Téléchargez le fichier à envoyer.',

    // Location fields
    'latitude' => 'Latitude',
    'longitude' => 'Longitude',
    'location_name' => 'Nom du Lieu',
    'location_name_placeholder' => 'ex: Mon Bureau',
    'location_address' => 'Adresse',
    'location_address_placeholder' => 'ex: 123 Rue Principale, Ville',

    // Contact fields
    'contact_name' => 'Nom du Contact',
    'contact_number' => 'Téléphone du Contact',

    // Notifications
    'success_title' => 'Message Envoyé !',
    'success_body' => 'Votre message WhatsApp a été envoyé avec succès.',
    'error_title' => 'Échec de l\'Envoi',
    'missing_required_fields' => 'L\'ID de l\'instance et le numéro de téléphone sont requis.',
    'unsupported_type' => 'Type de message non supporté.',
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
