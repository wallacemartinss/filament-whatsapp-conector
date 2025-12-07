<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Instâncias',
    'navigation_group' => 'WhatsApp',
    'model_label' => 'Instância',
    'plural_model_label' => 'Instâncias',

    'sections' => [
        'instance_info' => 'Informações da Instância',
        'settings' => 'Configurações',
        'connection' => 'Conexão',
    ],

    'fields' => [
        'name' => 'Nome da Instância',
        'name_helper' => 'Um nome único para identificar esta instância',
        'number' => 'Número de Telefone',
        'number_helper' => 'O número do WhatsApp com código do país',
        'status' => 'Status',
        'profile_picture' => 'Foto de Perfil',
        'reject_call' => 'Rejeitar Chamadas',
        'reject_call_helper' => 'Rejeitar automaticamente chamadas recebidas',
        'msg_call' => 'Mensagem de Rejeição',
        'msg_call_helper' => 'Mensagem enviada ao rejeitar uma chamada',
        'groups_ignore' => 'Ignorar Grupos',
        'groups_ignore_helper' => 'Não processar mensagens de grupos',
        'always_online' => 'Sempre Online',
        'always_online_helper' => 'Manter o status como online',
        'read_messages' => 'Ler Mensagens',
        'read_messages_helper' => 'Marcar mensagens como lidas automaticamente',
        'read_status' => 'Ler Status',
        'read_status_helper' => 'Visualizar atualizações de status automaticamente',
        'sync_full_history' => 'Sincronizar Histórico Completo',
        'sync_full_history_helper' => 'Sincronizar todo o histórico de mensagens ao conectar',
        'created_at' => 'Criado em',
        'updated_at' => 'Atualizado em',
    ],

    'actions' => [
        'connect' => 'Conectar',
        'disconnect' => 'Desconectar',
        'delete' => 'Excluir',
        'refresh' => 'Atualizar',
        'view_qrcode' => 'Ver QR Code',
        'close' => 'Fechar',
        'back' => 'Voltar para Lista',
    ],

    'messages' => [
        'created' => 'Instância criada com sucesso',
        'updated' => 'Instância atualizada com sucesso',
        'deleted' => 'Instância excluída com sucesso',
        'connected' => 'Instância conectada com sucesso',
        'disconnected' => 'Instância desconectada com sucesso',
        'connection_failed' => 'Falha ao conectar a instância',
    ],
];
