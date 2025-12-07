<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Evolution API Connection
    |--------------------------------------------------------------------------
    |
    | These settings are required and must be defined in your .env file.
    | NEVER store these credentials in the database!
    |
    */
    'api' => [
        'base_url' => env('EVOLUTION_URL', env('EVOLUTION_API_URL', 'http://localhost:8080')),
        'api_key' => env('EVOLUTION_API_KEY'),
        'timeout' => env('EVOLUTION_TIMEOUT', 30),
        'retry' => [
            'times' => 3,
            'sleep' => 100, // ms
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Webhook Configuration
    |--------------------------------------------------------------------------
    |
    | The secret is used to validate that webhooks come from Evolution API.
    |
    */
    'webhook' => [
        'enabled' => env('EVOLUTION_WEBHOOK_ENABLED', true),
        'url' => env('EVOLUTION_URL_WEBHOOK'),
        'path' => env('EVOLUTION_WEBHOOK_PATH', 'api/evolution/webhook'),
        'secret' => env('EVOLUTION_WEBHOOK_SECRET'),
        'verify_signature' => env('EVOLUTION_VERIFY_SIGNATURE', true),
        'by_events' => env('EVOLUTION_WEBHOOK_BY_EVENTS', false),
        'base64' => env('EVOLUTION_WEBHOOK_BASE64', false),
        'queue' => env('EVOLUTION_WEBHOOK_QUEUE', 'default'),
        'events' => [
            'APPLICATION_STARTUP',
            'QRCODE_UPDATED',
            'CONNECTION_UPDATE',
            'NEW_TOKEN',
            'SEND_MESSAGE',
            'PRESENCE_UPDATE',
            'MESSAGES_UPSERT',
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
        'integration' => env('EVOLUTION_INTEGRATION', 'WHATSAPP-BAILEYS'),
        'qrcode_expires_in' => env('EVOLUTION_QRCODE_EXPIRES', 30), // seconds
        'reject_call' => env('EVOLUTION_REJECT_CALL', false),
        'msg_call' => env('EVOLUTION_MSG_CALL', ''),
        'groups_ignore' => env('EVOLUTION_GROUPS_IGNORE', false),
        'always_online' => env('EVOLUTION_ALWAYS_ONLINE', false),
        'read_messages' => env('EVOLUTION_READ_MESSAGES', false),
        'read_status' => env('EVOLUTION_READ_STATUS', false),
        'sync_full_history' => env('EVOLUTION_SYNC_HISTORY', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Filament Configuration
    |--------------------------------------------------------------------------
    |
    | UI settings for Filament panel integration.
    | Labels and translations are handled via lang files.
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
        'enabled' => env('EVOLUTION_CACHE_ENABLED', true),
        'ttl' => env('EVOLUTION_CACHE_TTL', 60), // seconds
        'prefix' => 'evolution_',
    ],

    /*
    |--------------------------------------------------------------------------
    | Queue Configuration
    |--------------------------------------------------------------------------
    */
    'queue' => [
        'connection' => env('EVOLUTION_QUEUE_CONNECTION'),
        'messages' => env('EVOLUTION_QUEUE_MESSAGES', 'whatsapp'),
        'webhooks' => env('EVOLUTION_QUEUE_WEBHOOKS', 'default'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Logging
    |--------------------------------------------------------------------------
    */
    'logging' => [
        'enabled' => env('EVOLUTION_LOGGING', true),
        'channel' => env('EVOLUTION_LOG_CHANNEL'),
        'log_payloads' => env('EVOLUTION_LOG_PAYLOADS', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Multi-Tenancy Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for Filament multi-tenancy support.
    | When enabled, migrations will include the tenant foreign key
    | and models will automatically scope queries by tenant.
    |
    */
    'tenancy' => [
        'enabled' => env('EVOLUTION_TENANCY_ENABLED', false),

        // Tenant column name (e.g., 'team_id', 'company_id', 'tenant_id')
        'column' => env('EVOLUTION_TENANT_COLUMN', 'team_id'),

        // Tenant table for foreign key (e.g., 'teams', 'companies', 'tenants')
        'table' => env('EVOLUTION_TENANT_TABLE', 'teams'),

        // Tenant model class (e.g., App\Models\Team::class)
        'model' => env('EVOLUTION_TENANT_MODEL', 'App\\Models\\Team'),

        // Tenant column type ('uuid' or 'id')
        'column_type' => env('EVOLUTION_TENANT_COLUMN_TYPE', 'uuid'),
    ],
];
