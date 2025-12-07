<?php

declare(strict_types=1);

return [
    'status_connection' => [
        'open' => '已连接',
        'connecting' => '连接中',
        'close' => '已断开',
        'refused' => '已拒绝',
    ],

    'message_type' => [
        'text' => '文本',
        'image' => '图片',
        'audio' => '音频',
        'video' => '视频',
        'document' => '文档',
        'location' => '位置',
        'contact' => '联系人',
        'sticker' => '贴纸',
    ],

    'message_direction' => [
        'incoming' => '收到',
        'outgoing' => '发出',
    ],

    'message_status' => [
        'pending' => '待处理',
        'sent' => '已发送',
        'delivered' => '已送达',
        'read' => '已读',
        'failed' => '失败',
    ],

    'webhook_event' => [
        'application_startup' => '应用启动',
        'qrcode_updated' => '二维码已更新',
        'connection_update' => '连接更新',
        'messages_set' => '消息已设置',
        'messages_upsert' => '收到消息',
        'messages_update' => '消息已更新',
        'messages_delete' => '消息已删除',
        'send_message' => '消息已发送',
        'presence_update' => '状态更新',
        'new_token' => '新令牌',
        'logout_instance' => '实例登出',
        'remove_instance' => '实例已删除',
    ],
];
