<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Evolution API Connection (Required - .env)
    |--------------------------------------------------------------------------
    |
    | These are the only settings that MUST be in your .env file.
    | All other settings can be customized directly in this config file.
    |
    */
    'api' => [
        'base_url' => env('EVOLUTION_URL'),
        'api_key' => env('EVOLUTION_API_KEY'),
        'timeout' => 30,
        'retry' => [
            'times' => 3,
            'sleep' => 100, // milliseconds
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Webhook Configuration
    |--------------------------------------------------------------------------
    |
    | URL and secret should be in .env, other settings are optional.
    |
    */
    'webhook' => [
        'url' => env('EVOLUTION_WEBHOOK_URL'),
        'secret' => env('EVOLUTION_WEBHOOK_SECRET'),
        'path' => 'api/evolution/webhook',
        'events' => [
            'APPLICATION_STARTUP',
            'QRCODE_UPDATED',
            'CONNECTION_UPDATE',
            'NEW_TOKEN',
            'SEND_MESSAGE',
            'PRESENCE_UPDATE',
            'MESSAGES_UPSERT',
            'MESSAGES_UPDATE',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Instance Defaults
    |--------------------------------------------------------------------------
    |
    | Default settings for new WhatsApp instances.
    |
    */
    'instance' => [
        'integration' => 'WHATSAPP-BAILEYS',
        'qrcode_expires_in' => 30, // seconds
        'reject_call' => false,
        'msg_call' => '',
        'groups_ignore' => false,
        'always_online' => false,
        'read_messages' => false,
        'read_status' => false,
        'sync_full_history' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Queue Configuration
    |--------------------------------------------------------------------------
    |
    | Configure queue for processing webhooks and sending messages.
    |
    */
    'queue' => [
        'enabled' => true,
        'connection' => null, // null = use default connection
        'name' => 'default',
    ],

    /*
    |--------------------------------------------------------------------------
    | Storage Configuration
    |--------------------------------------------------------------------------
    |
    | Configure whether to store webhook events and messages in the database.
    | Disabling these can improve performance but you'll lose history.
    |
    */
    'storage' => [
        'webhooks' => true,
        'messages' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Cleanup Policy
    |--------------------------------------------------------------------------
    |
    | Automatic cleanup of old records. Set days to null to disable cleanup.
    | Run the cleanup command: php artisan evolution:cleanup
    | Schedule it in your app/Console/Kernel.php or routes/console.php
    |
    */
    'cleanup' => [
        'webhooks_days' => 30,   // Delete webhooks older than X days (null = never)
        'messages_days' => 90,   // Delete messages older than X days (null = never)
    ],

    /*
    |--------------------------------------------------------------------------
    | Media Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for media file uploads when sending messages.
    |
    */
    'media' => [
        'disk' => 'public',
        'directory' => 'whatsapp-media',
        'max_size' => 16384, // KB (16MB default)
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Instance
    |--------------------------------------------------------------------------
    |
    | The default instance ID to use when sending messages without specifying one.
    |
    */
    'default_instance' => env('EVOLUTION_DEFAULT_INSTANCE'),

    /*
    |--------------------------------------------------------------------------
    | Filament Configuration
    |--------------------------------------------------------------------------
    |
    | UI settings for Filament panel integration.
    |
    */
    'filament' => [
        'navigation_sort' => 100,
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Configuration
    |--------------------------------------------------------------------------
    */
    'cache' => [
        'enabled' => true,
        'ttl' => 60, // seconds
        'prefix' => 'evolution_',
    ],

    /*
    |--------------------------------------------------------------------------
    | Logging
    |--------------------------------------------------------------------------
    */
    'logging' => [
        'enabled' => true,
        'channel' => null, // null = use default channel
        'webhook_events' => false,
        'webhook_errors' => true,
        'log_payloads' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Multi-Tenancy Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for Filament multi-tenancy support.
    | Edit these values directly to enable multi-tenancy in your application.
    |
    */
    'tenancy' => [
        'enabled' => false,
        'column' => 'team_id',
        'table' => 'teams',
        'model' => 'App\\Models\\Team',
        'column_type' => 'uuid', // 'uuid' or 'id'
    ],
];
