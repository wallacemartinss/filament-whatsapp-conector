<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Instancias',
    'navigation_group' => 'WhatsApp',
    'model_label' => 'Instancia',
    'plural_model_label' => 'Instancias',

    'sections' => [
        'instance_info' => 'Información de la Instancia',
        'settings' => 'Configuración',
        'connection' => 'Conexión',
    ],

    'fields' => [
        'name' => 'Nombre de la Instancia',
        'name_helper' => 'Un nombre único para identificar esta instancia',
        'number' => 'Número de Teléfono',
        'number_helper' => 'El número de teléfono de WhatsApp con código de país',
        'status' => 'Estado',
        'profile_picture' => 'Foto de Perfil',
        'reject_call' => 'Rechazar Llamadas',
        'reject_call_helper' => 'Rechazar automáticamente las llamadas entrantes',
        'msg_call' => 'Mensaje de Rechazo',
        'msg_call_helper' => 'Mensaje enviado al rechazar una llamada',
        'groups_ignore' => 'Ignorar Grupos',
        'groups_ignore_helper' => 'No procesar mensajes de grupos',
        'always_online' => 'Siempre en Línea',
        'always_online_helper' => 'Mantener el estado como en línea',
        'read_messages' => 'Leer Mensajes',
        'read_messages_helper' => 'Marcar automáticamente los mensajes como leídos',
        'read_status' => 'Leer Estado',
        'read_status_helper' => 'Ver automáticamente las actualizaciones de estado',
        'sync_full_history' => 'Sincronizar Historial Completo',
        'sync_full_history_helper' => 'Sincronizar todo el historial de mensajes al conectar',
        'created_at' => 'Creado el',
        'updated_at' => 'Actualizado el',
    ],

    'actions' => [
        'connect' => 'Conectar',
        'disconnect' => 'Desconectar',
        'delete' => 'Eliminar',
        'refresh' => 'Actualizar',
        'view_qrcode' => 'Ver Código QR',
        'close' => 'Cerrar',
        'back' => 'Volver a la Lista',
    ],

    'messages' => [
        'created' => 'Instancia creada exitosamente',
        'updated' => 'Instancia actualizada exitosamente',
        'deleted' => 'Instancia eliminada exitosamente',
        'connected' => 'Instancia conectada exitosamente',
        'disconnected' => 'Instancia desconectada exitosamente',
        'connection_failed' => 'Error al conectar la instancia',
    ],
];
