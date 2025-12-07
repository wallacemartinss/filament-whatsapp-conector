<?php

declare(strict_types=1);

return [
    'status_connection' => [
        'open' => 'Conectado',
        'connecting' => 'Conectando',
        'close' => 'Desconectado',
        'refused' => 'Rechazado',
    ],

    'message_type' => [
        'text' => 'Texto',
        'image' => 'Imagen',
        'audio' => 'Audio',
        'video' => 'Video',
        'document' => 'Documento',
        'location' => 'Ubicación',
        'contact' => 'Contacto',
        'sticker' => 'Sticker',
    ],

    'message_direction' => [
        'incoming' => 'Entrante',
        'outgoing' => 'Saliente',
    ],

    'message_status' => [
        'pending' => 'Pendiente',
        'sent' => 'Enviado',
        'delivered' => 'Entregado',
        'read' => 'Leído',
        'failed' => 'Fallido',
    ],

    'webhook_event' => [
        'application_startup' => 'Inicio de Aplicación',
        'qrcode_updated' => 'Código QR Actualizado',
        'connection_update' => 'Actualización de Conexión',
        'messages_set' => 'Mensajes Establecidos',
        'messages_upsert' => 'Mensaje Recibido',
        'messages_update' => 'Mensaje Actualizado',
        'messages_delete' => 'Mensaje Eliminado',
        'send_message' => 'Mensaje Enviado',
        'presence_update' => 'Actualización de Presencia',
        'new_token' => 'Nuevo Token',
        'logout_instance' => 'Cierre de Sesión de Instancia',
        'remove_instance' => 'Instancia Eliminada',
    ],
];
