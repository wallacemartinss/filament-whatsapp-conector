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
];
