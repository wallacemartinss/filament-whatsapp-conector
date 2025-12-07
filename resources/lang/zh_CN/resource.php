<?php

declare(strict_types=1);

return [
    'navigation_label' => '实例',
    'navigation_group' => 'WhatsApp',
    'model_label' => '实例',
    'plural_model_label' => '实例',

    'sections' => [
        'instance_info' => '实例信息',
        'settings' => '设置',
        'connection' => '连接',
    ],

    'fields' => [
        'name' => '实例名称',
        'name_helper' => '用于识别此实例的唯一名称',
        'number' => '电话号码',
        'number_helper' => '带国家代码的WhatsApp电话号码',
        'status' => '状态',
        'profile_picture' => '头像',
        'reject_call' => '拒绝来电',
        'reject_call_helper' => '自动拒绝来电',
        'msg_call' => '拒绝消息',
        'msg_call_helper' => '拒绝来电时发送的消息',
        'groups_ignore' => '忽略群组',
        'groups_ignore_helper' => '不处理群组消息',
        'always_online' => '始终在线',
        'always_online_helper' => '保持在线状态',
        'read_messages' => '已读消息',
        'read_messages_helper' => '自动将消息标记为已读',
        'read_status' => '查看状态',
        'read_status_helper' => '自动查看状态更新',
        'sync_full_history' => '同步完整历史',
        'sync_full_history_helper' => '连接时同步所有消息历史',
        'created_at' => '创建时间',
        'updated_at' => '更新时间',
    ],

    'actions' => [
        'connect' => '连接',
        'disconnect' => '断开连接',
        'delete' => '删除',
        'refresh' => '刷新',
        'view_qrcode' => '查看二维码',
        'close' => '关闭',
        'back' => '返回列表',
    ],

    'messages' => [
        'created' => '实例创建成功',
        'updated' => '实例更新成功',
        'deleted' => '实例删除成功',
        'connected' => '实例连接成功',
        'disconnected' => '实例断开连接成功',
        'connection_failed' => '实例连接失败',
    ],
];
