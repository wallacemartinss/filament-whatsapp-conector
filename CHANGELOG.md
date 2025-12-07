# Changelog

All notable changes to `filament-whatsapp-conector` will be documented in this file.

## [0.2.0] - 2025-12-07

### Added

#### SendWhatsappMessageAction
- Reusable Filament Action for sending WhatsApp messages from anywhere
- Support for all message types: Text, Image, Video, Audio, Document, Location, Contact
- Dynamic form with conditional fields based on message type
- File upload with configurable disk (local, S3, etc.)
- Pre-fill support for number, instance, and message
- Option to restrict allowed message types (e.g., `textOnly()`)
- Full i18n support (English and Portuguese)

#### CanSendWhatsappMessage Trait
- Easy-to-use trait for sending messages from any service class
- Methods: `sendWhatsappText()`, `sendWhatsappImage()`, `sendWhatsappVideo()`, etc.
- Automatic instance selection with `getWhatsappInstanceId()` override support
- `hasWhatsappInstance()` check for conditional messaging

#### WhatsappService
- High-level service for message sending
- Automatic phone number formatting (adds country code if missing)
- Smart file URL handling (local URL vs S3 temporary URLs)
- Support for all Evolution API message types
- Instance validation before sending

#### Whatsapp Facade
- Quick access to WhatsappService methods
- `Whatsapp::sendText()`, `Whatsapp::sendImage()`, etc.
- `Whatsapp::getConnectedInstances()` for listing active instances

#### Media Configuration
- New config options for media storage:
  - `EVOLUTION_MEDIA_DISK` - Storage disk for uploads
  - `EVOLUTION_MEDIA_DIRECTORY` - Upload directory
  - `EVOLUTION_MEDIA_MAX_SIZE` - Max file size in KB
- `EVOLUTION_DEFAULT_INSTANCE` - Default instance for trait usage

### Fixed
- Added missing `sendVideo()` method to EvolutionClient

---

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

