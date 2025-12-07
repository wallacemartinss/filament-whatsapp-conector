# Filament Evolution - WhatsApp Connector

[![Latest Version on Packagist](https://img.shields.io/packagist/v/wallacemartinss/filament-whatsapp-conector.svg?style=flat-square)](https://packagist.org/packages/wallacemartinss/filament-whatsapp-conector)
[![Total Downloads](https://img.shields.io/packagist/dt/wallacemartinss/filament-whatsapp-conector.svg?style=flat-square)](https://packagist.org/packages/wallacemartinss/filament-whatsapp-conector)

A Filament v4 plugin for WhatsApp integration using [Evolution API v2](https://doc.evolution-api.com/).

## Features

- 🔌 **Easy Integration** - Connect your WhatsApp with Evolution API v2
- 🏢 **Multi-Tenancy** - Full support for Filament's native multi-tenancy
- 📱 **QR Code Connection** - Real-time QR code display with countdown timer
- 📨 **Webhook Support** - Receive events from Evolution API (messages, connection updates, etc.)
- 🔐 **Secure** - Credentials stored in config/env, never in database
- 🎨 **Filament v4 Native** - Beautiful UI with Filament components and Heroicons
- 🌍 **Translations** - Full i18n support (English and Portuguese included)
- ⚡ **Real-time** - Livewire-powered components with Alpine.js countdown

## Requirements

- PHP 8.2+
- Laravel 11+
- Filament v4
- Evolution API v2 instance

## Installation

```bash
composer require wallacemartinss/filament-whatsapp-conector
```

Publish the config file:

```bash
php artisan vendor:publish --tag="filament-evolution-config"
```

Run the migrations:

```bash
php artisan migrate
```

## Configuration

Add to your `.env`:

```env
# Evolution API (Required)
EVOLUTION_URL=https://your-evolution-api.com
EVOLUTION_API_KEY=your_api_key

# Webhook (Required for receiving events)
EVOLUTION_URL_WEBHOOK=https://your-app.com/api/webhooks/evolution
EVOLUTION_WEBHOOK_ENABLED=true

# QR Code Settings
EVOLUTION_QRCODE_EXPIRES=30

# Instance Defaults (Optional)
EVOLUTION_REJECT_CALL=false
EVOLUTION_MSG_CALL="I can't answer calls right now"
EVOLUTION_GROUPS_IGNORE=false
EVOLUTION_ALWAYS_ONLINE=false
EVOLUTION_READ_MESSAGES=false
EVOLUTION_READ_STATUS=false
EVOLUTION_SYNC_HISTORY=false

# Multi-Tenancy (Optional)
EVOLUTION_TENANCY_ENABLED=true
EVOLUTION_TENANT_COLUMN=team_id
EVOLUTION_TENANT_TABLE=teams
EVOLUTION_TENANT_MODEL=App\Models\Team
EVOLUTION_TENANT_COLUMN_TYPE=uuid
```

## Usage

### Register the Plugin

Add to your Filament Panel Provider:

```php
use WallaceMartinss\FilamentEvolution\FilamentEvolutionPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            FilamentEvolutionPlugin::make(),
        ]);
}
```

### Creating an Instance

1. Navigate to **WhatsApp > Instances**
2. Click **New Instance**
3. Fill in the instance name and phone number
4. Configure settings (reject calls, always online, etc.)
5. Click **Save** - the QR Code modal will open automatically
6. Scan the QR Code with your WhatsApp

### Instance Settings

When creating an instance, you can configure:

| Setting | Description |
|---------|-------------|
| **Reject Calls** | Automatically reject incoming calls |
| **Message on Call** | Message sent when rejecting calls |
| **Ignore Groups** | Don't process messages from groups |
| **Always Online** | Keep WhatsApp status as online |
| **Read Messages** | Automatically mark messages as read |
| **Read Status** | Automatically view status updates |
| **Sync Full History** | Sync all message history on connection |

### Webhook Events

The following events are sent to your webhook:

- `APPLICATION_STARTUP` - API started
- `QRCODE_UPDATED` - New QR code generated
- `CONNECTION_UPDATE` - Connection status changed
- `NEW_TOKEN` - New authentication token
- `SEND_MESSAGE` - Message sent
- `PRESENCE_UPDATE` - Contact online/offline
- `MESSAGES_UPSERT` - New message received

## Multi-Tenancy

The plugin supports Filament's native multi-tenancy. When enabled:

- All tables include the tenant foreign key
- Models automatically scope queries by tenant
- Records are auto-assigned to current tenant on creation

### Enable Multi-Tenancy

```env
EVOLUTION_TENANCY_ENABLED=true
EVOLUTION_TENANT_COLUMN=team_id
EVOLUTION_TENANT_TABLE=teams
EVOLUTION_TENANT_MODEL=App\Models\Team
```

## API

### Evolution Client

You can use the Evolution client directly:

```php
use WallaceMartinss\FilamentEvolution\Services\EvolutionClient;

$client = app(EvolutionClient::class);

// Create instance
$response = $client->createInstance('my-instance', '5511999999999', true, [
    'reject_call' => true,
    'always_online' => true,
]);

// Get connection state
$state = $client->getConnectionState('my-instance');

// Send text message
$client->sendText('my-instance', '5511999999999', 'Hello World!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Wallace Martins](https://github.com/wallacemartinss)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
