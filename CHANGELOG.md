# Changelog

All notable changes to Filament Evolution will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.1.0] - 2026-05-11

> Requires Evolution API **v2.4.0+** for the new interactive message types. All previous message types continue to work on any v2 release.

### Added

- **Interactive messages**: `sendButtons`, `sendCta`, `sendPix`, `sendList`, `sendCarousel` on the `Whatsapp` facade, `WhatsappService` and the `CanSendWhatsappMessage` trait.
- **New `MessageTypeEnum` cases**: `BUTTONS`, `LIST`, `CTA`, `PIX`, `CAROUSEL` (with `isInteractive()` helper).
- **`SendWhatsappMessageAction` form coverage** for all interactive types — reply buttons (max 3), CTA (max 2, url/call/copy), PIX with optional `amount`, list with nested sections + rows, and carousel with per-card buttons.
- **Translations** for the new keys across all 15 locales (en + pt_BR fully translated; remaining locales mirrored from English).

### Fixed

- **`qr_code_updated_at` column**: the package was writing to this column from `QrCodeDisplay` and `ProcessWebhookJob` but the migration never created it, causing `SQLSTATE[42S22] Unknown column 'qr_code_updated_at'` on strict MySQL setups. Migration stub now includes the column for fresh installs, and an upgrade migration (`add_qr_code_updated_at_to_whatsapp_instances_table`) ships for existing installs. `WhatsappInstance` model now declares the column as `fillable` and casts it to `datetime`.

### Upgrading from 2.0.0

```bash
php artisan vendor:publish --tag="filament-evolution-migrations"
php artisan migrate
```

The new upgrade migration is idempotent (checks `Schema::hasColumn` before adding/removing), so it is safe to run regardless of whether the column was patched manually.

## [1.0.0] - 2025-01-06

### 🎉 Initial Release

First official release of Filament Evolution - A powerful WhatsApp integration plugin for Filament v4 using Evolution API.

### Features

#### Instance Management
- Create, edit, and delete WhatsApp instances
- QR Code connection with real-time updates
- Instance status monitoring (connected, connecting, disconnected)
- Profile picture synchronization
- Connection settings (reject calls, ignore groups, always online, etc.)

#### Messaging
- Send and receive text messages
- Support for media types: images, audio, video, documents
- Location and contact sharing
- Message status tracking (pending, sent, delivered, read)
- Content preview in message list

#### Webhook Integration
- Automatic webhook event processing
- Event logging with payload storage
- Configurable event filtering
- Error tracking and debugging

#### Filament Action
- `SendWhatsappMessageAction` - Ready-to-use action for sending WhatsApp messages
- Supports all message types (text, image, audio, video, document, location, contact)
- Easy integration with any Filament resource

#### Services & Traits
- `WhatsappService` - High-level service for message sending
- `CanSendWhatsappMessage` trait for easy integration
- `Whatsapp` facade for quick access
- Automatic phone number formatting

#### Multi-Tenancy
- Native Filament multi-tenancy support
- Dynamic tenant column configuration
- Automatic query scoping by tenant

#### Internationalization
Full translation support for 15 languages:
- 🇺🇸 English (en)
- 🇧🇷 Portuguese Brazil (pt_BR)
- 🇸🇦 Arabic (ar)
- 🇩🇪 German (de)
- 🇪🇸 Spanish (es)
- 🇫🇷 French (fr)
- 🇮🇹 Italian (it)
- 🇯🇵 Japanese (ja)
- 🇰🇷 Korean (ko)
- 🇳🇱 Dutch (nl)
- 🇵🇱 Polish (pl)
- 🇷🇺 Russian (ru)
- 🇹🇷 Turkish (tr)
- 🇺🇦 Ukrainian (uk)
- 🇨🇳 Chinese Simplified (zh_CN)

### Technical Details

- **Requires**: PHP 8.2+, Laravel 11+, Filament 4+
- **Queue Support**: Messages and webhooks processed via Laravel queues
- **Database**: Migrations for instances, messages, and webhook logs
- **Config**: Fully customizable via `config/filament-evolution.php`

### Documentation

See [README.md](README.md) for installation and usage instructions

