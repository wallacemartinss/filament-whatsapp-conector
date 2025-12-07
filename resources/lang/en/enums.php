<?php

declare(strict_types=1);

return [
    'status_connection' => [
        'open' => 'Connected',
        'connecting' => 'Connecting',
        'close' => 'Disconnected',
        'refused' => 'Refused',
    ],

    'message_type' => [
        'text' => 'Text',
        'image' => 'Image',
        'audio' => 'Audio',
        'video' => 'Video',
        'document' => 'Document',
        'location' => 'Location',
        'contact' => 'Contact',
        'sticker' => 'Sticker',
    ],

    'message_direction' => [
        'incoming' => 'Incoming',
        'outgoing' => 'Outgoing',
    ],

    'message_status' => [
        'pending' => 'Pending',
        'sent' => 'Sent',
        'delivered' => 'Delivered',
        'read' => 'Read',
        'failed' => 'Failed',
    ],

    'webhook_event' => [
        'application_startup' => 'Application Startup',
        'qrcode_updated' => 'QR Code Updated',
        'connection_update' => 'Connection Update',
        'messages_set' => 'Messages Set',
        'messages_upsert' => 'Message Received',
        'messages_update' => 'Message Updated',
        'messages_delete' => 'Message Deleted',
        'send_message' => 'Message Sent',
        'presence_update' => 'Presence Update',
        'new_token' => 'New Token',
        'logout_instance' => 'Instance Logout',
        'remove_instance' => 'Instance Removed',
    ],
];
