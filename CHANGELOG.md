# Changelog

All notable changes to `filament-whatsapp-conector` will be documented in this file.

## [0.1.0] - 2025-12-07

### Added

#### Core Features
- Evolution API v2 integration with full HTTP client
- WhatsApp instance management (Create, Connect, Delete, Fetch, LogOut, Restart)
- Real-time QR Code display with Alpine.js countdown timer
- Pairing code support for WhatsApp Web linking
- Webhook endpoint for receiving Evolution API events
- Complete instance settings: reject calls, always online, read messages, sync history, etc.

#### Filament Integration
- Filament v4 Resource for WhatsApp instances
- Modern QR Code modal with auto-open after instance creation
- Table actions for Connect, View, and Edit
- Status badges with Filament's native components
- Full translations support (English and Portuguese)

#### Multi-Tenancy
- Native Filament multi-tenancy support
- Dynamic tenant column configuration
- Automatic query scoping by tenant
- Auto-assignment of tenant on record creation

#### Architecture
- DTOs with Spatie Laravel Data for type safety
- Laravel Events for extensibility (InstanceConnected, MessageReceived, etc.)
- Background job processing for webhooks and messages
- Configurable webhook events
- Secure credential storage via environment variables

#### Developer Experience
- Comprehensive configuration file
- Migration stubs with tenancy support
- Livewire components for real-time updates
- PHPStan and Pint ready

### Configuration Options

```env
# Required
EVOLUTION_URL=https://your-evolution-api.com
EVOLUTION_API_KEY=your_api_key
EVOLUTION_URL_WEBHOOK=https://your-app.com/api/webhooks/evolution

# Optional
EVOLUTION_QRCODE_EXPIRES=30
EVOLUTION_TENANCY_ENABLED=true
EVOLUTION_TENANT_COLUMN=team_id
```
