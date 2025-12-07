<?php

declare(strict_types=1);

return [
    'status_connection' => [
        'open' => 'Conectado',
        'connecting' => 'Conectando',
        'close' => 'Desconectado',
        'refused' => 'Recusado',
    ],

    'message_type' => [
        'text' => 'Texto',
        'image' => 'Imagem',
        'audio' => 'Áudio',
        'video' => 'Vídeo',
        'document' => 'Documento',
        'location' => 'Localização',
        'contact' => 'Contato',
        'sticker' => 'Figurinha',
    ],

    'message_direction' => [
        'incoming' => 'Recebida',
        'outgoing' => 'Enviada',
    ],

    'message_status' => [
        'pending' => 'Pendente',
        'sent' => 'Enviado',
        'delivered' => 'Entregue',
        'read' => 'Lido',
        'failed' => 'Falhou',
    ],

    'webhook_event' => [
        'application_startup' => 'Inicialização do Aplicativo',
        'qrcode_updated' => 'QR Code Atualizado',
        'connection_update' => 'Atualização de Conexão',
        'messages_set' => 'Mensagens Definidas',
        'messages_upsert' => 'Mensagem Recebida',
        'messages_update' => 'Mensagem Atualizada',
        'messages_delete' => 'Mensagem Excluída',
        'send_message' => 'Mensagem Enviada',
        'presence_update' => 'Atualização de Presença',
        'new_token' => 'Novo Token',
        'logout_instance' => 'Logout da Instância',
        'remove_instance' => 'Instância Removida',
    ],
];
