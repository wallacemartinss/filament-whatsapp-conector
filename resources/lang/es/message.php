<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Mensajes',
    'model_label' => 'Mensaje',
    'plural_model_label' => 'Mensajes',

    'sections' => [
        'message_info' => 'Información del Mensaje',
        'content' => 'Contenido',
        'timestamps' => 'Marcas de Tiempo',
        'raw_payload' => 'Datos Crudos',
    ],

    'fields' => [
        'instance' => 'Instancia',
        'direction' => 'Dirección',
        'phone' => 'Teléfono',
        'type' => 'Tipo',
        'content' => 'Contenido',
        'status' => 'Estado',
        'message_id' => 'ID del Mensaje',
        'media' => 'Multimedia',
        'media_caption' => 'Leyenda del Archivo',
        'media_url' => 'URL del Archivo',
        'location' => 'Ubicación',
        'sent_at' => 'Enviado el',
        'delivered_at' => 'Entregado el',
        'read_at' => 'Leído el',
        'created_at' => 'Creado el',
    ],
];
