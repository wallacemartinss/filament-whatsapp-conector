<?php

declare(strict_types=1);

return [
    'send_message' => 'Enviar Mensaje de WhatsApp',
    'modal_heading' => 'Enviar Mensaje de WhatsApp',
    'modal_description' => 'Enviar un mensaje a un número de WhatsApp.',
    'send' => 'Enviar Mensaje',

    // Form fields
    'instance' => 'Instancia',
    'instance_helper' => 'Seleccione la instancia de WhatsApp para enviar el mensaje.',
    'number' => 'Número de Teléfono',
    'number_helper' => 'Ingrese el número de teléfono con código de país (ej: 5491155555555).',
    'type' => 'Tipo de Mensaje',
    'message' => 'Mensaje',
    'message_placeholder' => 'Escriba su mensaje aquí...',
    'caption' => 'Leyenda',
    'caption_placeholder' => 'Leyenda opcional para el archivo...',
    'media' => 'Archivo Multimedia',
    'media_helper' => 'Suba el archivo a enviar.',

    // Location fields
    'latitude' => 'Latitud',
    'longitude' => 'Longitud',
    'location_name' => 'Nombre del Lugar',
    'location_name_placeholder' => 'ej: Mi Oficina',
    'location_address' => 'Dirección',
    'location_address_placeholder' => 'ej: Calle Principal 123, Ciudad',

    // Contact fields
    'contact_name' => 'Nombre del Contacto',
    'contact_number' => 'Teléfono del Contacto',

    // Notifications
    'success_title' => '¡Mensaje Enviado!',
    'success_body' => 'Su mensaje de WhatsApp ha sido enviado exitosamente.',
    'error_title' => 'Error al Enviar',
    'missing_required_fields' => 'El ID de instancia y el número de teléfono son requeridos.',
    'unsupported_type' => 'Tipo de mensaje no soportado.',
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
