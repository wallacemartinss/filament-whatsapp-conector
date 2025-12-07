<?php

declare(strict_types=1);

return [
    'send_message' => '发送WhatsApp消息',
    'modal_heading' => '发送WhatsApp消息',
    'modal_description' => '向WhatsApp号码发送消息。',
    'send' => '发送消息',

    // Form fields
    'instance' => '实例',
    'instance_helper' => '选择用于发送消息的WhatsApp实例。',
    'number' => '电话号码',
    'number_helper' => '输入带国家代码的电话号码（例如：8613812345678）。',
    'type' => '消息类型',
    'message' => '消息',
    'message_placeholder' => '在此输入您的消息...',
    'caption' => '说明',
    'caption_placeholder' => '媒体的可选说明...',
    'media' => '媒体文件',
    'media_helper' => '上传要发送的文件。',

    // Location fields
    'latitude' => '纬度',
    'longitude' => '经度',
    'location_name' => '位置名称',
    'location_name_placeholder' => '例如：我的办公室',
    'location_address' => '地址',
    'location_address_placeholder' => '例如：主街123号，城市',

    // Contact fields
    'contact_name' => '联系人姓名',
    'contact_number' => '联系人电话',

    // Notifications
    'success_title' => '消息已发送！',
    'success_body' => '您的WhatsApp消息已成功发送。',
    'error_title' => '发送失败',
    'missing_required_fields' => '需要实例ID和电话号码。',
    'unsupported_type' => '不支持的消息类型。',
];
