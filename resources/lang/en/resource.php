<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Instances',
    'navigation_group' => 'WhatsApp',
    'model_label' => 'Instance',
    'plural_model_label' => 'Instances',

    'sections' => [
        'instance_info' => 'Instance Information',
        'settings' => 'Settings',
        'connection' => 'Connection',
    ],

    'fields' => [
        'name' => 'Instance Name',
        'name_helper' => 'A unique name to identify this instance',
        'number' => 'Phone Number',
        'number_helper' => 'The WhatsApp phone number with country code',
        'status' => 'Status',
        'profile_picture' => 'Profile Picture',
        'reject_call' => 'Reject Calls',
        'reject_call_helper' => 'Automatically reject incoming calls',
        'msg_call' => 'Rejection Message',
        'msg_call_helper' => 'Message sent when rejecting a call',
        'groups_ignore' => 'Ignore Groups',
        'groups_ignore_helper' => 'Do not process messages from groups',
        'always_online' => 'Always Online',
        'always_online_helper' => 'Keep the status as online',
        'read_messages' => 'Read Messages',
        'read_messages_helper' => 'Automatically mark messages as read',
        'read_status' => 'Read Status',
        'read_status_helper' => 'Automatically view status updates',
        'sync_full_history' => 'Sync Full History',
        'sync_full_history_helper' => 'Synchronize all message history on connection',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
    ],

    'actions' => [
        'connect' => 'Connect',
        'disconnect' => 'Disconnect',
        'delete' => 'Delete',
        'refresh' => 'Refresh',
        'view_qrcode' => 'View QR Code',
        'close' => 'Close',
        'back' => 'Back to List',
    ],

    'messages' => [
        'created' => 'Instance created successfully',
        'updated' => 'Instance updated successfully',
        'deleted' => 'Instance deleted successfully',
        'connected' => 'Instance connected successfully',
        'disconnected' => 'Instance disconnected successfully',
        'connection_failed' => 'Failed to connect instance',
    ],
];
