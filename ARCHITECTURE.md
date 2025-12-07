# Filament Evolution - Arquitetura do Plugin

Plugin Filament para integração com Evolution API v2 (WhatsApp).

---

## 🏢 Multi-Tenancy

> O plugin suporta **multi-tenancy nativo do Filament v4** através de configuração dinâmica.

### Características

| Feature | Descrição |
|---------|-----------|
| **Habilitação** | Via `config('filament-evolution.tenancy.enabled')` |
| **Coluna Dinâmica** | Configurável: `team_id`, `company_id`, `tenant_id`, etc. |
| **Tipo de Coluna** | Suporta `uuid` ou `id` (bigint) |
| **Scope Automático** | Models aplicam filtro por tenant automaticamente |
| **Auto-fill** | Tenant ID é preenchido automaticamente ao criar registros |

### Configuração Rápida

```env
# .env
EVOLUTION_TENANCY_ENABLED=true
EVOLUTION_TENANT_COLUMN=team_id
EVOLUTION_TENANT_TABLE=teams
EVOLUTION_TENANT_MODEL=App\Models\Team
EVOLUTION_TENANT_COLUMN_TYPE=uuid
```

> 📖 Veja a seção **Models com Multi-Tenancy** para detalhes de implementação.
```

---

## 📊 Análise da Estrutura Atual

### ✅ O que você JÁ TEM (e funciona bem):

| Componente | Arquivo | Status |
|------------|---------|--------|
| **Config** | `config/filament-evolution.php` | 🔵 NOVO - Config própria do plugin |
| **Model** | `app/Models/WhatsappInstance.php` | ✅ Com UUID, casts, fillable |
| **Migration** | `create_whatsapp_instances_table.php` | ✅ Campos completos |
| **Enum** | `StatusConnectionEnum.php` | ✅ Com HasLabel, HasColor |
| **HTTP Client** | `EvolutionClientTrait.php` | ✅ Trait reutilizável |
| **Services Instance** | 6 services (Create, Connect, Delete, etc.) | ✅ Funcionais |
| **Services Message** | `SendMessageEvolutionService.php` | ✅ Funcional |
| **Webhook Controller** | `EvolutionWebhookController.php` | ✅ Switch por evento |
| **Filament Resource** | `WhatsappInstanceResource.php` | ✅ Com Form/Table/Infolist separados |
| **Livewire QR Code** | `EvolutionQrCode.php` | ✅ Com polling e countdown |
| **Views** | `evolution-qr-code.blade.php` | ✅ UI completa |

### ❌ O que FALTA (para melhorar qualidade e manutenibilidade):

| Componente | Benefício |
|------------|-----------|
| **DTOs** | Tipagem forte, autocomplete, validação |
| **Events** | Desacoplamento, extensibilidade |
| **Listeners** | Reação a eventos de forma organizada |
| **Jobs** | Processamento em background |
| **Exceptions** | Tratamento de erro consistente |
| **Contracts/Interfaces** | Testabilidade, injeção de dependência |
| **Testes** | Confiabilidade, refatoração segura |

---

## 🔐 Filosofia de Segurança

### Credenciais vs Dados Operacionais

| Tipo | Onde Armazenar | Exemplo |
|------|----------------|---------|
| **Credenciais** | `.env` / Config | API Key, Webhook Secret, URL do servidor |
| **Dados Operacionais** | Banco de Dados | Nome da instância, status, número conectado |

### Por que essa separação?

1. **Segurança**: Credenciais no `.env` não vazam em backups de banco
2. **Reutilização**: Mesma API Key para múltiplas instâncias
3. **Deploy**: Credenciais diferentes por ambiente (dev/staging/prod)
4. **Compliance**: Facilita auditoria e rotação de chaves

### Fluxo de Autenticação

```
┌─────────────────┐     ┌───────────────────────────┐     ┌─────────────────┐
│   Sua App       │────▶│  Plugin                   │────▶│ Evolution API   │
│                 │     │                           │     │                 │
│ Cria instância  │     │ config/filament-evolution │     │ Valida API Key  │
│ "minha-loja"    │     │    └── api.global_token   │     │ Retorna dados   │
└─────────────────┘     └───────────────────────────┘     └─────────────────┘
                              │
                              ▼
                    ┌──────────────────┐
                    │   Banco de Dados │
                    │                  │
                    │ Salva apenas:    │
                    │ - team_id 🏢     │
                    │ - name           │
                    │ - status         │
                    │ - number         │
                    │ - settings       │
                    └──────────────────┘
```

---

## 📁 Estrutura de Diretórios

> 🟢 = Já existe | 🟡 = Modificar | 🔵 = Criar novo

```
app/
├── Enums/
│   └── Evolution/
│       ├── 🟢 StatusConnectionEnum.php      # Já existe - manter
│       ├── 🔵 MessageStatusEnum.php         # NOVO: pending, sent, delivered, read, failed
│       ├── 🔵 MessageTypeEnum.php           # NOVO: text, image, audio, video, document
│       └── 🔵 WebhookEventEnum.php          # NOVO: Todos os eventos suportados
│
├── Data/                                     # 🔵 NOVO: DTOs com Spatie Data
│   └── Evolution/
│       ├── InstanceData.php                 # Dados para criar instância
│       ├── MessageData.php                  # Dados de mensagem
│       ├── ContactData.php                  # Dados de contato
│       ├── QrCodeData.php                   # QR Code + pairing code
│       ├── ConnectionStatusData.php         # Status de conexão
│       └── Webhook/
│           ├── WebhookPayloadData.php       # Payload base
│           ├── QrCodeUpdatedData.php        # Evento QRCODE_UPDATED
│           ├── ConnectionUpdateData.php     # Evento CONNECTION_UPDATE
│           └── MessageUpsertData.php        # Evento MESSAGES_UPSERT
│
├── Events/                                   # 🔵 NOVO: Eventos Laravel
│   └── Evolution/
│       ├── InstanceCreated.php
│       ├── InstanceConnected.php
│       ├── InstanceDisconnected.php
│       ├── QrCodeUpdated.php
│       ├── MessageReceived.php
│       ├── MessageSent.php
│       └── MessageStatusUpdated.php
│
├── Exceptions/                               # 🔵 NOVO: Exceções customizadas
│   └── Evolution/
│       ├── EvolutionException.php           # Base
│       ├── ConnectionException.php
│       ├── InstanceNotFoundException.php
│       └── MessageFailedException.php
│
├── Filament/
│   └── Resources/
│       └── WhatsappInstances/               # 🟢 Já existe - manter estrutura
│           ├── Pages/
│           ├── Schemas/
│           ├── Tables/
│           └── WhatsappInstanceResource.php
│
├── Http/
│   └── Controllers/
│       └── Webhook/
│           └── 🟡 EvolutionWebhookController.php  # MODIFICAR: usar DTOs e Jobs
│
├── Jobs/                                     # 🔵 NOVO: Jobs para background
│   └── Evolution/
│       ├── ProcessWebhookJob.php            # Processa webhook
│       ├── SendMessageJob.php               # Envia mensagem
│       ├── SendBulkMessagesJob.php          # Envio em massa
│       └── SyncInstanceStatusJob.php        # Sincroniza status
│
├── Listeners/                                # 🔵 NOVO: Listeners
│   └── Evolution/
│       ├── LogMessageReceived.php
│       ├── UpdateInstanceStatus.php
│       ├── ClearQrCodeOnConnection.php
│       └── NotifyOnDisconnection.php
│
├── Livewire/
│   └── Evolution/
│       └── 🟢 EvolutionQrCode.php           # Já existe - manter
│
├── Models/
│   ├── 🟢 WhatsappInstance.php              # Já existe - manter
│   └── 🔵 WhatsappMessage.php               # NOVO: Histórico de mensagens
│
├── Services/
│   ├── Traits/
│   │   └── 🟡 EvolutionClientTrait.php      # MODIFICAR: adicionar retry, exceptions
│   └── Evolution/
│       ├── Instance/
│       │   ├── 🟢 CreateEvolutionInstanceService.php   # Manter
│       │   ├── 🟢 ConnectEvolutionInstanceService.php  # Manter
│       │   ├── 🟢 DeleteEvolutionInstanceService.php   # Manter
│       │   ├── 🟢 FetchEvolutionInstanceService.php    # Manter
│       │   ├── 🟢 LogOutEvolutionInstanceService.php   # Manter
│       │   └── 🟢 RestartEvolutionInstanceService.php  # Manter
│       ├── Message/
│       │   ├── 🟢 SendMessageEvolutionService.php      # Manter
│       │   ├── 🔵 SendMediaEvolutionService.php        # NOVO
│       │   ├── 🔵 SendAudioEvolutionService.php        # NOVO
│       │   └── 🔵 SendDocumentEvolutionService.php     # NOVO
│       └── 🔵 WebhookService.php             # NOVO: Configurar webhook
│
├── Contracts/                                # 🔵 NOVO: Interfaces
│   └── Evolution/
│       ├── EvolutionClientInterface.php
│       └── MessageServiceInterface.php
│
config/
│   └── 🟢 services.php                      # Já existe com evolution key
│
database/
│   └── migrations/
│       ├── 🟢 create_whatsapp_instances_table.php  # Já existe
│       ├── 🔵 create_whatsapp_messages_table.php   # NOVO
│       └── 🔵 create_whatsapp_webhooks_table.php   # NOVO (log)
│
resources/
│   └── views/
│       ├── filament/app/pages/evolution/
│       │   └── 🟢 qr-code-modal.blade.php   # Já existe
│       └── livewire/evolution/
│           └── 🟢 evolution-qr-code.blade.php  # Já existe
│
routes/
│   └── 🟡 api.php ou web.php                # Verificar rota do webhook
│
tests/
│   ├── Feature/
│   │   └── Evolution/
│   │       ├── 🔵 InstanceResourceTest.php
│   │       ├── 🔵 WebhookControllerTest.php
│   │       └── 🔵 SendMessageTest.php
│   └── Unit/
│       └── Evolution/
│           ├── 🔵 EvolutionClientTest.php
│           ├── 🔵 InstanceServiceTest.php
│           ├── 🔵 WebhookPayloadDataTest.php
│           └── 🔵 StatusConnectionEnumTest.php
```

---

## 🗄️ Models e Migrations

### WhatsappInstance (🟡 MODIFICAR - Adicionar suporte a tenant)

```php
// database/migrations/xxxx_create_whatsapp_instances_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('whatsapp_instances', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // 🏢 Tenant column dinâmico baseado na config
            $this->addTenantColumn($table);

            $table->string('name');
            $table->string('number');
            $table->string('instance_id')->nullable();
            $table->string('profile_picture_url')->nullable();
            $table->string('status')->nullable();
            $table->boolean('reject_call')->default(true);
            $table->string('msg_call')->nullable();
            $table->boolean('groups_ignore')->default(true);
            $table->boolean('always_online')->default(true);
            $table->boolean('read_messages')->default(true);
            $table->boolean('read_status')->default(true);
            $table->boolean('sync_full_history')->default(true);
            $table->string('count')->nullable();
            $table->string('pairing_code')->nullable();
            $table->longText('qr_code')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Adiciona coluna de tenant dinamicamente baseado na config
     */
    private function addTenantColumn(Blueprint $table): void
    {
        if (!config('filament-evolution.tenancy.enabled', false)) {
            return;
        }

        $column = config('filament-evolution.tenancy.column', 'team_id');
        $tenantTable = config('filament-evolution.tenancy.table', 'teams');
        $columnType = config('filament-evolution.tenancy.column_type', 'uuid');

        if ($columnType === 'uuid') {
            $table->foreignUuid($column)
                ->constrained($tenantTable)
                ->cascadeOnDelete();
        } else {
            $table->foreignId($column)
                ->constrained($tenantTable)
                ->cascadeOnDelete();
        }

        $table->index($column);
    }
};
```

### WhatsappMessage (🔵 NOVO - Com tenant dinâmico)

```php
// database/migrations/xxxx_create_whatsapp_messages_table.php
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('whatsapp_messages', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // 🏢 Tenant column dinâmico
            $this->addTenantColumn($table);

            $table->foreignUuid('instance_id')->constrained('whatsapp_instances')->cascadeOnDelete();
            $table->string('message_id')->index();
            $table->string('remote_jid');
            $table->string('phone');
            $table->enum('direction', ['incoming', 'outgoing']);
            $table->string('type')->default('text');
            $table->text('content')->nullable();
            $table->json('media')->nullable();
            $table->string('status')->default('pending');
            $table->json('raw_payload')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->index(['instance_id', 'phone']);
            $table->index(['instance_id', 'created_at']);
        });
    }

    private function addTenantColumn(Blueprint $table): void
    {
        // Mesmo método do WhatsappInstance
        if (!config('filament-evolution.tenancy.enabled', false)) {
            return;
        }

        $column = config('filament-evolution.tenancy.column', 'team_id');
        $tenantTable = config('filament-evolution.tenancy.table', 'teams');
        $columnType = config('filament-evolution.tenancy.column_type', 'uuid');

        if ($columnType === 'uuid') {
            $table->foreignUuid($column)->constrained($tenantTable)->cascadeOnDelete();
        } else {
            $table->foreignId($column)->constrained($tenantTable)->cascadeOnDelete();
        }

        $table->index($column);
    }
};
```

### WhatsappWebhook (🔵 NOVO - Log de webhooks com tenant)

```php
// database/migrations/xxxx_create_whatsapp_webhooks_table.php
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('whatsapp_webhooks', function (Blueprint $table) {
            $table->id();

            // 🏢 Tenant column dinâmico
            $this->addTenantColumn($table);

            $table->foreignUuid('instance_id')->nullable()->constrained('whatsapp_instances')->nullOnDelete();
            $table->string('event');
            $table->json('payload');
            $table->boolean('processed')->default(false);
            $table->text('error')->nullable();
            $table->integer('processing_time_ms')->nullable();
            $table->timestamps();

            $table->index(['event', 'processed']);
            $table->index('created_at');
        });
    }

    private function addTenantColumn(Blueprint $table): void
    {
        // Mesmo método
        if (!config('filament-evolution.tenancy.enabled', false)) {
            return;
        }

        $column = config('filament-evolution.tenancy.column', 'team_id');
        $tenantTable = config('filament-evolution.tenancy.table', 'teams');
        $columnType = config('filament-evolution.tenancy.column_type', 'uuid');

        if ($columnType === 'uuid') {
            $table->foreignUuid($column)->constrained($tenantTable)->cascadeOnDelete();
        } else {
            $table->foreignId($column)->constrained($tenantTable)->cascadeOnDelete();
        }

        $table->index($column);
    }
};
```

### Trait para Migrations com Tenant

```php
// src/Database/Migrations/Concerns/HasTenantColumn.php
namespace WallaceMartinss\FilamentEvolution\Database\Migrations\Concerns;

use Illuminate\Database\Schema\Blueprint;

trait HasTenantColumn
{
    protected function addTenantColumn(Blueprint $table): void
    {
        if (!config('filament-evolution.tenancy.enabled', false)) {
            return;
        }

        $column = config('filament-evolution.tenancy.column', 'team_id');
        $tenantTable = config('filament-evolution.tenancy.table', 'teams');
        $columnType = config('filament-evolution.tenancy.column_type', 'uuid');

        if ($columnType === 'uuid') {
            $table->foreignUuid($column)
                ->constrained($tenantTable)
                ->cascadeOnDelete();
        } else {
            $table->foreignId($column)
                ->constrained($tenantTable)
                ->cascadeOnDelete();
        }

        $table->index($column);
    }
}
```

---

## 🏢 Models com Multi-Tenancy

### Trait para Models com Tenant

```php
// src/Models/Concerns/HasTenant.php
namespace WallaceMartinss\FilamentEvolution\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasTenant
{
    public static function bootHasTenant(): void
    {
        if (!config('filament-evolution.tenancy.enabled', false)) {
            return;
        }

        // Global scope para filtrar por tenant
        static::addGlobalScope('tenant', function (Builder $query) {
            $tenantColumn = config('filament-evolution.tenancy.column', 'team_id');
            $tenant = filament()->getTenant();

            if ($tenant) {
                $query->where($tenantColumn, $tenant->getKey());
            }
        });

        // Auto-preenche tenant ao criar
        static::creating(function ($model) {
            $tenantColumn = config('filament-evolution.tenancy.column', 'team_id');
            $tenant = filament()->getTenant();

            if ($tenant && empty($model->{$tenantColumn})) {
                $model->{$tenantColumn} = $tenant->getKey();
            }
        });
    }

    /**
     * Relacionamento dinâmico com o Tenant
     */
    public function tenant(): ?BelongsTo
    {
        if (!config('filament-evolution.tenancy.enabled', false)) {
            return null;
        }

        $tenantColumn = config('filament-evolution.tenancy.column', 'team_id');
        $tenantModel = config('filament-evolution.tenancy.model', 'App\\Models\\Team');

        return $this->belongsTo($tenantModel, $tenantColumn);
    }

    /**
     * Retorna o nome da coluna do tenant
     */
    public function getTenantColumn(): ?string
    {
        if (!config('filament-evolution.tenancy.enabled', false)) {
            return null;
        }

        return config('filament-evolution.tenancy.column', 'team_id');
    }
}
```

### WhatsappInstance Model

```php
// src/Models/WhatsappInstance.php
namespace WallaceMartinss\FilamentEvolution\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use WallaceMartinss\FilamentEvolution\Enums\StatusConnectionEnum;
use WallaceMartinss\FilamentEvolution\Models\Concerns\HasTenant;

class WhatsappInstance extends Model
{
    use HasUuids;
    use HasTenant;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'number',
        'instance_id',
        'profile_picture_url',
        'status',
        'reject_call',
        'msg_call',
        'groups_ignore',
        'always_online',
        'read_messages',
        'read_status',
        'sync_full_history',
        'count',
        'pairing_code',
        'qr_code',
    ];

    protected function casts(): array
    {
        return [
            'status' => StatusConnectionEnum::class,
            'reject_call' => 'boolean',
            'groups_ignore' => 'boolean',
            'always_online' => 'boolean',
            'read_messages' => 'boolean',
            'read_status' => 'boolean',
            'sync_full_history' => 'boolean',
        ];
    }

    public function messages(): HasMany
    {
        return $this->hasMany(WhatsappMessage::class, 'instance_id');
    }

    public function webhooks(): HasMany
    {
        return $this->hasMany(WhatsappWebhook::class, 'instance_id');
    }

    public function isConnected(): bool
    {
        return $this->status === StatusConnectionEnum::OPEN;
    }

    public function isDisconnected(): bool
    {
        return in_array($this->status, [
            StatusConnectionEnum::CLOSE,
            StatusConnectionEnum::REFUSED,
        ]);
    }
}
```

### WhatsappMessage Model

```php
// src/Models/WhatsappMessage.php
namespace WallaceMartinss\FilamentEvolution\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use WallaceMartinss\FilamentEvolution\Enums\MessageDirectionEnum;
use WallaceMartinss\FilamentEvolution\Enums\MessageStatusEnum;
use WallaceMartinss\FilamentEvolution\Enums\MessageTypeEnum;
use WallaceMartinss\FilamentEvolution\Models\Concerns\HasTenant;

class WhatsappMessage extends Model
{
    use HasUuids;
    use HasTenant;

    protected $fillable = [
        'instance_id',
        'message_id',
        'remote_jid',
        'phone',
        'direction',
        'type',
        'content',
        'media',
        'status',
        'raw_payload',
        'sent_at',
        'delivered_at',
        'read_at',
    ];

    protected function casts(): array
    {
        return [
            'direction' => MessageDirectionEnum::class,
            'type' => MessageTypeEnum::class,
            'status' => MessageStatusEnum::class,
            'media' => 'array',
            'raw_payload' => 'array',
            'sent_at' => 'datetime',
            'delivered_at' => 'datetime',
            'read_at' => 'datetime',
        ];
    }

    public function instance(): BelongsTo
    {
        return $this->belongsTo(WhatsappInstance::class, 'instance_id');
    }

    public function isIncoming(): bool
    {
        return $this->direction === MessageDirectionEnum::INCOMING;
    }

    public function isOutgoing(): bool
    {
        return $this->direction === MessageDirectionEnum::OUTGOING;
    }
}
```

---

## 📦 DTOs (Data Transfer Objects)

> Usando [Spatie Laravel Data](https://spatie.be/docs/laravel-data) para tipagem forte e validação.

### InstanceData

```php
// app/Data/Evolution/InstanceData.php
namespace App\Data\Evolution;

use Spatie\LaravelData\Data;

class InstanceData extends Data
{
    public function __construct(
        public string $name,
        public string $number,
        public bool $rejectCall = true,
        public ?string $msgCall = null,
        public bool $groupsIgnore = true,
        public bool $alwaysOnline = true,
        public bool $readMessages = true,
        public bool $readStatus = true,
        public bool $syncFullHistory = true,
    ) {}

    public function toApiPayload(): array
    {
        return [
            'instanceName'    => $this->name,
            'number'          => preg_replace('/\D/', '', $this->number),
            'qrcode'          => true,
            'integration'     => config('filament-evolution.instance.integration', 'WHATSAPP-BAILEYS'),
            'rejectCall'      => $this->rejectCall,
            'msgCall'         => $this->msgCall ?? '',
            'groupsIgnore'    => $this->groupsIgnore,
            'alwaysOnline'    => $this->alwaysOnline,
            'readMessages'    => $this->readMessages,
            'readStatus'      => $this->readStatus,
            'syncFullHistory' => $this->syncFullHistory,
            'webhook'         => [
                'url'      => url(config('filament-evolution.webhook.path')),
                'byEvents' => false,
                'base64'   => false,
                'events'   => config('filament-evolution.webhook.events', [
                    'QRCODE_UPDATED',
                    'CONNECTION_UPDATE',
                    'MESSAGES_UPSERT',
                ]),
            ],
        ];
    }
}
```

### QrCodeData

```php
// app/Data/Evolution/QrCodeData.php
namespace App\Data\Evolution;

use Spatie\LaravelData\Data;

class QrCodeData extends Data
{
    public function __construct(
        public ?string $base64 = null,
        public ?string $pairingCode = null,
        public ?string $code = null,
        public ?int $count = null,
    ) {}

    public static function fromApiResponse(array $response): self
    {
        return new self(
            base64: $response['base64'] ?? $response['qrcode']['base64'] ?? null,
            pairingCode: $response['pairingCode'] ?? $response['qrcode']['pairingCode'] ?? null,
            code: $response['code'] ?? null,
            count: $response['count'] ?? null,
        );
    }

    public function isValid(): bool
    {
        return $this->base64 !== null;
    }
}
```

### MessageData

```php
// app/Data/Evolution/MessageData.php
namespace App\Data\Evolution;

use App\Enums\Evolution\MessageTypeEnum;
use Spatie\LaravelData\Data;

class MessageData extends Data
{
    public function __construct(
        public string $number,
        public string $content,
        public MessageTypeEnum $type = MessageTypeEnum::TEXT,
        public ?string $caption = null,
        public ?string $mediaUrl = null,
        public ?string $filename = null,
        public ?int $delay = null,
    ) {}

    public function toApiPayload(): array
    {
        $number = preg_replace('/\D/', '', $this->number);

        return match($this->type) {
            MessageTypeEnum::TEXT => [
                'number' => $number,
                'text'   => $this->content,
            ],
            MessageTypeEnum::IMAGE, MessageTypeEnum::VIDEO => [
                'number'  => $number,
                'media'   => $this->mediaUrl ?? $this->content,
                'caption' => $this->caption ?? '',
            ],
            MessageTypeEnum::AUDIO => [
                'number' => $number,
                'audio'  => $this->mediaUrl ?? $this->content,
            ],
            MessageTypeEnum::DOCUMENT => [
                'number'   => $number,
                'document' => $this->mediaUrl ?? $this->content,
                'filename' => $this->filename ?? 'document',
            ],
            default => ['number' => $number, 'text' => $this->content],
        };
    }
}
```

### Webhook DTOs

```php
// app/Data/Evolution/Webhook/ConnectionUpdateData.php
namespace App\Data\Evolution\Webhook;

use App\Enums\Evolution\StatusConnectionEnum;
use Spatie\LaravelData\Data;

class ConnectionUpdateData extends Data
{
    public function __construct(
        public string $instance,
        public string $state,
        public ?int $statusReason = null,
    ) {}

    public static function fromWebhook(array $payload): self
    {
        return new self(
            instance: $payload['instance'],
            state: $payload['data']['state'],
            statusReason: $payload['data']['statusReason'] ?? null,
        );
    }

    public function getStatus(): StatusConnectionEnum
    {
        return StatusConnectionEnum::tryFrom($this->state)
            ?? StatusConnectionEnum::CLOSE;
    }

    public function isConnected(): bool
    {
        return $this->state === 'open';
    }

    public function isDisconnected(): bool
    {
        return in_array($this->state, ['close', 'refused']);
    }
}
```

```php
// app/Data/Evolution/Webhook/QrCodeUpdatedData.php
namespace App\Data\Evolution\Webhook;

use App\Data\Evolution\QrCodeData;
use Spatie\LaravelData\Data;

class QrCodeUpdatedData extends Data
{
    public function __construct(
        public string $instance,
        public QrCodeData $qrCode,
    ) {}

    public static function fromWebhook(array $payload): self
    {
        return new self(
            instance: $payload['instance'],
            qrCode: new QrCodeData(
                base64: $payload['data']['qrcode']['base64'] ?? null,
                pairingCode: $payload['data']['qrcode']['pairingCode'] ?? null,
            ),
        );
    }
}
```

```php
// app/Data/Evolution/Webhook/MessageUpsertData.php
namespace App\Data\Evolution\Webhook;

use Spatie\LaravelData\Data;
use Illuminate\Support\Str;

class MessageUpsertData extends Data
{
    public function __construct(
        public string $instance,
        public string $messageId,
        public string $remoteJid,
        public string $phone,
        public bool $fromMe,
        public string $messageType,
        public ?string $text = null,
        public ?string $caption = null,
        public ?array $media = null,
        public ?int $timestamp = null,
    ) {}

    public static function fromWebhook(array $payload): self
    {
        $data = $payload['data'] ?? [];
        $key = $data['key'] ?? [];
        $message = $data['message'] ?? [];

        return new self(
            instance: $payload['instance'],
            messageId: $key['id'] ?? '',
            remoteJid: $key['remoteJid'] ?? '',
            phone: Str::before($key['remoteJid'] ?? '', '@'),
            fromMe: $key['fromMe'] ?? false,
            messageType: $data['messageType'] ?? 'unknown',
            text: $message['conversation']
                ?? $message['extendedTextMessage']['text']
                ?? null,
            caption: $message['imageMessage']['caption']
                ?? $message['videoMessage']['caption']
                ?? null,
            media: self::extractMedia($message),
            timestamp: isset($data['messageTimestamp'])
                ? (int) $data['messageTimestamp']
                : null,
        );
    }

    private static function extractMedia(array $message): ?array
    {
        $mediaTypes = ['imageMessage', 'audioMessage', 'videoMessage', 'documentMessage'];

        foreach ($mediaTypes as $type) {
            if (isset($message[$type])) {
                return [
                    'type' => $type,
                    'mimetype' => $message[$type]['mimetype'] ?? null,
                    'url' => $message[$type]['url'] ?? null,
                ];
            }
        }

        return null;
    }

    public function isIncoming(): bool
    {
        return !$this->fromMe;
    }

    public function getContent(): ?string
    {
        return $this->text ?? $this->caption;
    }
}
```

---

## ⚙️ Arquivo de Configuração

> 🔐 **Todas as credenciais ficam aqui, nunca no banco de dados!**

```php
// config/filament-evolution.php
return [
    /*
    |--------------------------------------------------------------------------
    | Evolution API Connection (CREDENCIAIS SENSÍVEIS)
    |--------------------------------------------------------------------------
    |
    | Estas configurações são obrigatórias e devem ser definidas no .env
    | NUNCA armazene estas credenciais no banco de dados!
    |
    */
    'api' => [
        'base_url' => env('EVOLUTION_API_URL', 'http://localhost:8080'),
        'global_token' => env('EVOLUTION_API_KEY'),  // 🔐 API Key global
        'timeout' => env('EVOLUTION_TIMEOUT', 30),
        'retry' => [
            'times' => 3,
            'sleep' => 100, // ms
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Webhook Configuration (SEGURANÇA)
    |--------------------------------------------------------------------------
    |
    | O secret é usado para validar que os webhooks vêm da Evolution API
    |
    */
    'webhook' => [
        'path' => env('EVOLUTION_WEBHOOK_PATH', 'api/evolution/webhook'),
        'secret' => env('EVOLUTION_WEBHOOK_SECRET'),  // 🔐 Para validar origem
        'verify_signature' => env('EVOLUTION_VERIFY_SIGNATURE', true),
        'queue' => env('EVOLUTION_WEBHOOK_QUEUE', 'default'),
        'events' => [
            'QRCODE_UPDATED',
            'CONNECTION_UPDATE',
            'MESSAGES_UPSERT',
            'MESSAGES_UPDATE',
            'MESSAGES_DELETE',
            'SEND_MESSAGE',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Instance Defaults (Configurações padrão para novas instâncias)
    |--------------------------------------------------------------------------
    */
    'instance' => [
        'integration' => env('EVOLUTION_INTEGRATION', 'WHATSAPP-BAILEYS'),
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
    */
    'filament' => [
        'navigation_group' => 'WhatsApp',
        'navigation_icon' => 'fab-whatsapp',
        'navigation_sort' => 100,
        'resource_label' => 'Instância',
        'resource_plural_label' => 'Instâncias',
    ],

    /*
    |--------------------------------------------------------------------------
    | Storage & Cache
    |--------------------------------------------------------------------------
    */
    'cache' => [
        'enabled' => true,
        'ttl' => 60, // segundos
        'prefix' => 'evolution_',
    ],

    /*
    |--------------------------------------------------------------------------
    | Queue Configuration
    |--------------------------------------------------------------------------
    */
    'queue' => [
        'connection' => env('EVOLUTION_QUEUE_CONNECTION', 'redis'),
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
        'channel' => env('EVOLUTION_LOG_CHANNEL', 'stack'),
        'log_payloads' => env('EVOLUTION_LOG_PAYLOADS', false), // Cuidado: pode conter dados sensíveis
    ],

    /*
    |--------------------------------------------------------------------------
    | Multi-Tenancy Configuration
    |--------------------------------------------------------------------------
    |
    | Configuração para suporte a múltiplos tenants no Filament.
    | Se habilitado, as migrations incluirão a foreign key do tenant
    | e os models aplicarão scope automático.
    |
    */
    'tenancy' => [
        'enabled' => env('EVOLUTION_TENANCY_ENABLED', false),

        // Nome da coluna de tenant nas tabelas (ex: 'team_id', 'company_id', 'tenant_id')
        'column' => env('EVOLUTION_TENANT_COLUMN', 'team_id'),

        // Tabela do tenant para a foreign key (ex: 'teams', 'companies', 'tenants')
        'table' => env('EVOLUTION_TENANT_TABLE', 'teams'),

        // Model do tenant (ex: App\Models\Team::class)
        'model' => env('EVOLUTION_TENANT_MODEL', 'App\\Models\\Team'),

        // Tipo da coluna do tenant ('uuid' ou 'id')
        'column_type' => env('EVOLUTION_TENANT_COLUMN_TYPE', 'uuid'),
    ],
];
```

### Exemplo de `.env`

```env
# Evolution API - Credenciais (OBRIGATÓRIO)
EVOLUTION_API_URL=https://evolution.meudominio.com
EVOLUTION_API_KEY=seu_token_secreto_aqui

# Webhook
EVOLUTION_WEBHOOK_SECRET=meu_secret_para_validar_webhooks
EVOLUTION_WEBHOOK_PATH=api/evolution/webhook

# Configurações opcionais
EVOLUTION_INTEGRATION=WHATSAPP-BAILEYS
EVOLUTION_TIMEOUT=30
EVOLUTION_REJECT_CALL=false
EVOLUTION_GROUPS_IGNORE=false
EVOLUTION_ALWAYS_ONLINE=false

# Queue
EVOLUTION_QUEUE_CONNECTION=redis
EVOLUTION_QUEUE_MESSAGES=whatsapp

# Logging
EVOLUTION_LOGGING=true
EVOLUTION_LOG_PAYLOADS=false

# Multi-Tenancy (opcional)
EVOLUTION_TENANCY_ENABLED=true
EVOLUTION_TENANT_COLUMN=team_id
EVOLUTION_TENANT_TABLE=teams
EVOLUTION_TENANT_MODEL=App\Models\Team
EVOLUTION_TENANT_COLUMN_TYPE=uuid
```

---

## 📡 Events (Eventos Laravel)

> Eventos permitem desacoplar a lógica e facilitar extensões.

```php
// app/Events/Evolution/InstanceConnected.php
namespace App\Events\Evolution;

use App\Models\WhatsappInstance;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InstanceConnected
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public WhatsappInstance $instance,
    ) {}
}

// app/Events/Evolution/InstanceDisconnected.php
class InstanceDisconnected
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public WhatsappInstance $instance,
        public string $reason = 'unknown',
    ) {}
}

// app/Events/Evolution/QrCodeUpdated.php
use App\Data\Evolution\QrCodeData;

class QrCodeUpdated
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public WhatsappInstance $instance,
        public QrCodeData $qrCode,
    ) {}
}

// app/Events/Evolution/MessageReceived.php
use App\Data\Evolution\Webhook\MessageUpsertData;

class MessageReceived
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public WhatsappInstance $instance,
        public MessageUpsertData $message,
    ) {}
}

// app/Events/Evolution/MessageSent.php
class MessageSent
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public WhatsappInstance $instance,
        public string $phone,
        public string $messageId,
        public string $content,
    ) {}
}
```

---

## 👂 Listeners

```php
// app/Listeners/Evolution/UpdateInstanceStatus.php
namespace App\Listeners\Evolution;

use App\Events\Evolution\{InstanceConnected, InstanceDisconnected};
use App\Services\Evolution\Instance\FetchEvolutionInstanceService;

class UpdateInstanceStatus
{
    public function handleConnected(InstanceConnected $event): void
    {
        $event->instance->update([
            'status' => 'open',
            'qr_code' => null,
            'pairing_code' => null,
        ]);

        // Buscar foto de perfil
        app(FetchEvolutionInstanceService::class)->fetchInstance($event->instance->name);
    }

    public function handleDisconnected(InstanceDisconnected $event): void
    {
        $event->instance->update([
            'status' => 'close',
        ]);
    }
}

// app/Listeners/Evolution/ClearQrCodeOnConnection.php
class ClearQrCodeOnConnection
{
    public function handle(InstanceConnected $event): void
    {
        $event->instance->update([
            'qr_code' => null,
            'pairing_code' => null,
        ]);
    }
}

// app/Listeners/Evolution/LogMessageReceived.php
use App\Events\Evolution\MessageReceived;
use App\Models\WhatsappMessage;

class LogMessageReceived
{
    public function handle(MessageReceived $event): void
    {
        WhatsappMessage::create([
            'instance_id' => $event->instance->id,
            'message_id'  => $event->message->messageId,
            'remote_jid'  => $event->message->remoteJid,
            'phone'       => $event->message->phone,
            'direction'   => 'incoming',
            'type'        => $event->message->messageType,
            'content'     => $event->message->getContent(),
            'media'       => $event->message->media,
            'status'      => 'received',
        ]);
    }
}
```

### Registrar Listeners (EventServiceProvider)

```php
// app/Providers/EventServiceProvider.php
protected $listen = [
    \App\Events\Evolution\InstanceConnected::class => [
        \App\Listeners\Evolution\UpdateInstanceStatus::class . '@handleConnected',
        \App\Listeners\Evolution\ClearQrCodeOnConnection::class,
    ],
    \App\Events\Evolution\InstanceDisconnected::class => [
        \App\Listeners\Evolution\UpdateInstanceStatus::class . '@handleDisconnected',
    ],
    \App\Events\Evolution\MessageReceived::class => [
        \App\Listeners\Evolution\LogMessageReceived::class,
    ],
];
```

---

## ⚡ Jobs (Processamento em Background)

```php
// app/Jobs/Evolution/ProcessWebhookJob.php
namespace App\Jobs\Evolution;

use App\Data\Evolution\Webhook\{ConnectionUpdateData, MessageUpsertData, QrCodeUpdatedData};
use App\Enums\Evolution\WebhookEventEnum;
use App\Events\Evolution\{InstanceConnected, InstanceDisconnected, MessageReceived, QrCodeUpdated};
use App\Models\{WhatsappInstance, WhatsappWebhook};
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\{InteractsWithQueue, SerializesModels};

class ProcessWebhookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public string $event,
        public array $payload,
    ) {}

    public function handle(): void
    {
        $startTime = microtime(true);
        $webhookLog = null;

        try {
            $instance = WhatsappInstance::where('name', $this->payload['instance'] ?? null)->first();

            // Log do webhook
            $webhookLog = WhatsappWebhook::create([
                'instance_id' => $instance?->id,
                'event'       => $this->event,
                'payload'     => $this->payload,
                'processed'   => false,
            ]);

            match($this->event) {
                'connection.update' => $this->handleConnectionUpdate($instance),
                'qrcode.updated'    => $this->handleQrCodeUpdated($instance),
                'messages.upsert'   => $this->handleMessageUpsert($instance),
                default => null,
            };

            $webhookLog->update([
                'processed' => true,
                'processing_time_ms' => (int) ((microtime(true) - $startTime) * 1000),
            ]);

        } catch (\Throwable $e) {
            $webhookLog?->update([
                'error' => $e->getMessage(),
                'processing_time_ms' => (int) ((microtime(true) - $startTime) * 1000),
            ]);

            throw $e;
        }
    }

    private function handleConnectionUpdate(?WhatsappInstance $instance): void
    {
        if (!$instance) return;

        $data = ConnectionUpdateData::fromWebhook($this->payload);

        if ($data->isConnected()) {
            event(new InstanceConnected($instance));
        } elseif ($data->isDisconnected()) {
            event(new InstanceDisconnected($instance, $data->state));
        }

        $instance->update(['status' => $data->state]);
    }

    private function handleQrCodeUpdated(?WhatsappInstance $instance): void
    {
        if (!$instance) return;

        $data = QrCodeUpdatedData::fromWebhook($this->payload);

        $instance->update([
            'qr_code'      => $data->qrCode->base64,
            'pairing_code' => $data->qrCode->pairingCode,
        ]);

        event(new QrCodeUpdated($instance, $data->qrCode));
    }

    private function handleMessageUpsert(?WhatsappInstance $instance): void
    {
        if (!$instance) return;

        $data = MessageUpsertData::fromWebhook($this->payload);

        if ($data->isIncoming()) {
            event(new MessageReceived($instance, $data));
        }
    }
}
```

```php
// app/Jobs/Evolution/SendMessageJob.php
namespace App\Jobs\Evolution;

use App\Data\Evolution\MessageData;
use App\Events\Evolution\MessageSent;
use App\Models\{WhatsappInstance, WhatsappMessage};
use App\Services\Evolution\Message\SendMessageEvolutionService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\{InteractsWithQueue, SerializesModels};

class SendMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $backoff = 5;

    public function __construct(
        public WhatsappInstance $instance,
        public MessageData $message,
    ) {}

    public function handle(SendMessageEvolutionService $service): void
    {
        $response = $service->sendMessage($this->instance->name, [
            'number_whatsapp' => $this->message->number,
            'message'         => $this->message->content,
        ]);

        if (isset($response['error'])) {
            throw new \Exception($response['error']);
        }

        // Salvar mensagem enviada
        WhatsappMessage::create([
            'instance_id' => $this->instance->id,
            'message_id'  => $response['key']['id'] ?? '',
            'remote_jid'  => $response['key']['remoteJid'] ?? '',
            'phone'       => $this->message->number,
            'direction'   => 'outgoing',
            'type'        => 'text',
            'content'     => $this->message->content,
            'status'      => $response['status'] ?? 'pending',
            'sent_at'     => now(),
        ]);

        event(new MessageSent(
            $this->instance,
            $this->message->number,
            $response['key']['id'] ?? '',
            $this->message->content,
        ));
    }
}
```

---

## 🔄 Webhook Controller Refatorado

```php
// app/Http/Controllers/Webhook/EvolutionWebhookController.php
namespace App\Http\Controllers\Webhook;

use App\Http\Controllers\Controller;
use App\Jobs\Evolution\ProcessWebhookJob;
use Illuminate\Http\{JsonResponse, Request};

class EvolutionWebhookController extends Controller
{
    public function handle(Request $request): JsonResponse
    {
        $event = $request->input('event');
        $payload = $request->all();

        // Despacha para processamento em background
        ProcessWebhookJob::dispatch($event, $payload)
            ->onQueue(config('services.evolution.webhook_queue', 'default'));

        return response()->json(['status' => 'queued']);
    }
}
```

---

## 🎯 Enums

### StatusConnectionEnum (🟢 JÁ EXISTE - Perfeito!)

```php
// Seu enum atual - PERFEITO, não precisa mudar
namespace App\Enums\Evolution;

use Filament\Support\Contracts\{HasColor, HasLabel};

enum StatusConnectionEnum: string implements HasLabel, HasColor
{
    case CLOSE      = 'close';
    case OPEN       = 'open';
    case CONNECTING = 'connecting';
    case REFUSED    = 'refused';

    public function getLabel(): string
    {
        return match ($this) {
            self::OPEN       => 'Conectado',
            self::CONNECTING => 'Conectando',
            self::CLOSE      => 'Desconectado',
            self::REFUSED    => 'Recusado',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::OPEN       => 'success',
            self::CONNECTING => 'warning',
            self::CLOSE      => 'danger',
            self::REFUSED    => 'danger',
        };
    }
}
```

### MessageTypeEnum (🔵 NOVO)

```php
// app/Enums/Evolution/MessageTypeEnum.php
namespace App\Enums\Evolution;

use Filament\Support\Contracts\{HasColor, HasIcon, HasLabel};

enum MessageTypeEnum: string implements HasLabel, HasColor, HasIcon
{
    case TEXT     = 'text';
    case IMAGE    = 'image';
    case AUDIO    = 'audio';
    case VIDEO    = 'video';
    case DOCUMENT = 'document';
    case LOCATION = 'location';
    case CONTACT  = 'contact';
    case STICKER  = 'sticker';

    public function getLabel(): string
    {
        return match ($this) {
            self::TEXT     => 'Texto',
            self::IMAGE    => 'Imagem',
            self::AUDIO    => 'Áudio',
            self::VIDEO    => 'Vídeo',
            self::DOCUMENT => 'Documento',
            self::LOCATION => 'Localização',
            self::CONTACT  => 'Contato',
            self::STICKER  => 'Figurinha',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::TEXT     => 'gray',
            self::IMAGE    => 'success',
            self::AUDIO    => 'warning',
            self::VIDEO    => 'info',
            self::DOCUMENT => 'primary',
            self::LOCATION => 'danger',
            self::CONTACT  => 'secondary',
            self::STICKER  => 'warning',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::TEXT     => 'heroicon-o-chat-bubble-left',
            self::IMAGE    => 'heroicon-o-photo',
            self::AUDIO    => 'heroicon-o-microphone',
            self::VIDEO    => 'heroicon-o-video-camera',
            self::DOCUMENT => 'heroicon-o-document',
            self::LOCATION => 'heroicon-o-map-pin',
            self::CONTACT  => 'heroicon-o-user',
            self::STICKER  => 'heroicon-o-face-smile',
        };
    }
}
```

### MessageDirectionEnum (🔵 NOVO)

```php
// src/Enums/MessageDirectionEnum.php
namespace WallaceMartinss\FilamentEvolution\Enums;

use Filament\Support\Contracts\{HasColor, HasIcon, HasLabel};

enum MessageDirectionEnum: string implements HasLabel, HasColor, HasIcon
{
    case INCOMING = 'incoming';
    case OUTGOING = 'outgoing';

    public function getLabel(): string
    {
        return match ($this) {
            self::INCOMING => 'Recebida',
            self::OUTGOING => 'Enviada',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::INCOMING => 'info',
            self::OUTGOING => 'success',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::INCOMING => 'heroicon-o-arrow-down-left',
            self::OUTGOING => 'heroicon-o-arrow-up-right',
        };
    }
}
```

### MessageStatusEnum (🔵 NOVO)

```php
// app/Enums/Evolution/MessageStatusEnum.php
namespace App\Enums\Evolution;

use Filament\Support\Contracts\{HasColor, HasIcon, HasLabel};

enum MessageStatusEnum: string implements HasLabel, HasColor, HasIcon
{
    case PENDING   = 'pending';
    case SENT      = 'sent';
    case DELIVERED = 'delivered';
    case READ      = 'read';
    case FAILED    = 'failed';

    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING   => 'Pendente',
            self::SENT      => 'Enviado',
            self::DELIVERED => 'Entregue',
            self::READ      => 'Lido',
            self::FAILED    => 'Falhou',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::PENDING   => 'gray',
            self::SENT      => 'info',
            self::DELIVERED => 'warning',
            self::READ      => 'success',
            self::FAILED    => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::PENDING   => 'heroicon-o-clock',
            self::SENT      => 'heroicon-o-check',
            self::DELIVERED => 'heroicon-o-check',  // ✓✓
            self::READ      => 'heroicon-o-check',  // ✓✓ azul
            self::FAILED    => 'heroicon-o-x-circle',
        };
    }
}
```

### WebhookEventEnum (🔵 NOVO)

```php
// app/Enums/Evolution/WebhookEventEnum.php
namespace App\Enums\Evolution;

enum WebhookEventEnum: string
{
    case APPLICATION_STARTUP = 'application.startup';
    case QRCODE_UPDATED = 'qrcode.updated';
    case CONNECTION_UPDATE = 'connection.update';
    case MESSAGES_SET = 'messages.set';
    case MESSAGES_UPSERT = 'messages.upsert';
    case MESSAGES_UPDATE = 'messages.update';
    case MESSAGES_DELETE = 'messages.delete';
    case SEND_MESSAGE = 'send.message';
    case PRESENCE_UPDATE = 'presence.update';
    case NEW_TOKEN = 'new.token';
    case LOGOUT_INSTANCE = 'logout.instance';
    case REMOVE_INSTANCE = 'remove.instance';

    public function label(): string
    {
        return match($this) {
            self::QRCODE_UPDATED    => 'QR Code Atualizado',
            self::CONNECTION_UPDATE => 'Status de Conexão',
            self::MESSAGES_UPSERT   => 'Mensagem Recebida',
            self::MESSAGES_UPDATE   => 'Mensagem Atualizada',
            self::SEND_MESSAGE      => 'Mensagem Enviada',
            self::LOGOUT_INSTANCE   => 'Logout da Instância',
            self::REMOVE_INSTANCE   => 'Instância Removida',
            default => $this->value,
        };
    }

    public function shouldProcess(): bool
    {
        return in_array($this, [
            self::QRCODE_UPDATED,
            self::CONNECTION_UPDATE,
            self::MESSAGES_UPSERT,
            self::SEND_MESSAGE,
        ]);
    }
}
```

---

## 🔌 Services (🟢 MANTER os existentes)

> Seus services atuais estão funcionais. Sugestão: adicionar tipagem com DTOs.

### Melhoria no EvolutionClientTrait

```php
// app/Services/Traits/EvolutionClientTrait.php
namespace App\Services\Traits;

use App\Exceptions\Evolution\{ConnectionException, EvolutionException};
use Illuminate\Support\Facades\Http;

trait EvolutionClientTrait
{
    protected string $apiKey;
    protected string $apiUrl;

    public function __construct()
    {
        $this->apiKey = config('services.evolution.key');
        $this->apiUrl = config('services.evolution.url');

        if (empty($this->apiKey) || empty($this->apiUrl)) {
            throw new EvolutionException('Evolution API não configurada. Verifique EVOLUTION_API_KEY e EVOLUTION_URL no .env');
        }
    }

    protected function makeRequest(string $endpoint, string $method = 'GET', array $data = []): array
    {
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'apikey'       => $this->apiKey,
            ])
            ->timeout(config('services.evolution.timeout', 30))
            ->retry(3, 100)
            ->{strtolower($method)}($this->apiUrl . $endpoint, $data);

            if ($response->failed()) {
                throw new ConnectionException(
                    "Erro na API Evolution: " . ($response->json()['message'] ?? $response->status())
                );
            }

            return $response->json();

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            throw new ConnectionException("Não foi possível conectar à API Evolution: " . $e->getMessage());
        }
    }
}
```

---

## 🧪 Estrutura de Testes

### Testes Unitários

```php
// tests/Unit/Evolution/StatusConnectionEnumTest.php
namespace Tests\Unit\Evolution;

use App\Enums\Evolution\StatusConnectionEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class StatusConnectionEnumTest extends TestCase
{
    #[Test]
    public function it_returns_correct_labels(): void
    {
        $this->assertEquals('Conectado', StatusConnectionEnum::OPEN->getLabel());
        $this->assertEquals('Desconectado', StatusConnectionEnum::CLOSE->getLabel());
        $this->assertEquals('Conectando', StatusConnectionEnum::CONNECTING->getLabel());
    }

    #[Test]
    public function it_returns_correct_colors(): void
    {
        $this->assertEquals('success', StatusConnectionEnum::OPEN->getColor());
        $this->assertEquals('danger', StatusConnectionEnum::CLOSE->getColor());
        $this->assertEquals('warning', StatusConnectionEnum::CONNECTING->getColor());
    }

    #[Test]
    public function it_can_be_created_from_string(): void
    {
        $this->assertEquals(StatusConnectionEnum::OPEN, StatusConnectionEnum::from('open'));
        $this->assertEquals(StatusConnectionEnum::CLOSE, StatusConnectionEnum::from('close'));
    }
}

// tests/Unit/Evolution/InstanceDataTest.php
namespace Tests\Unit\Evolution;

use App\Data\Evolution\InstanceData;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class InstanceDataTest extends TestCase
{
    #[Test]
    public function it_creates_instance_data(): void
    {
        $data = new InstanceData(
            name: 'test-instance',
            number: '5511999999999',
        );

        $this->assertEquals('test-instance', $data->name);
        $this->assertEquals('5511999999999', $data->number);
    }

    #[Test]
    public function it_converts_to_api_payload(): void
    {
        $data = new InstanceData(
            name: 'test-instance',
            number: '+55 (11) 99999-9999',
            rejectCall: true,
        );

        $payload = $data->toApiPayload();

        $this->assertEquals('test-instance', $payload['instanceName']);
        $this->assertEquals('5511999999999', $payload['number']); // Formatado
        $this->assertTrue($payload['rejectCall']);
        $this->assertArrayHasKey('webhook', $payload);
    }
}

// tests/Unit/Evolution/ConnectionUpdateDataTest.php
namespace Tests\Unit\Evolution;

use App\Data\Evolution\Webhook\ConnectionUpdateData;
use App\Enums\Evolution\StatusConnectionEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ConnectionUpdateDataTest extends TestCase
{
    #[Test]
    public function it_parses_webhook_payload(): void
    {
        $payload = [
            'instance' => 'test-instance',
            'data' => [
                'state' => 'open',
                'statusReason' => 200,
            ],
        ];

        $data = ConnectionUpdateData::fromWebhook($payload);

        $this->assertEquals('test-instance', $data->instance);
        $this->assertEquals('open', $data->state);
        $this->assertTrue($data->isConnected());
        $this->assertFalse($data->isDisconnected());
    }

    #[Test]
    public function it_detects_disconnection(): void
    {
        $payload = [
            'instance' => 'test-instance',
            'data' => ['state' => 'close'],
        ];

        $data = ConnectionUpdateData::fromWebhook($payload);

        $this->assertTrue($data->isDisconnected());
        $this->assertEquals(StatusConnectionEnum::CLOSE, $data->getStatus());
    }
}

// tests/Unit/Evolution/MessageUpsertDataTest.php
namespace Tests\Unit\Evolution;

use App\Data\Evolution\Webhook\MessageUpsertData;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MessageUpsertDataTest extends TestCase
{
    #[Test]
    public function it_parses_text_message(): void
    {
        $payload = $this->getFixture('messages-upsert.json');

        $data = MessageUpsertData::fromWebhook($payload);

        $this->assertEquals('test-instance', $data->instance);
        $this->assertEquals('5511999999999', $data->phone);
        $this->assertEquals('Olá, tudo bem?', $data->text);
        $this->assertTrue($data->isIncoming());
    }

    #[Test]
    public function it_extracts_caption_from_image(): void
    {
        $payload = [
            'instance' => 'test',
            'data' => [
                'key' => ['id' => '123', 'remoteJid' => '5511@s.whatsapp.net', 'fromMe' => false],
                'messageType' => 'imageMessage',
                'message' => [
                    'imageMessage' => [
                        'caption' => 'Foto do produto',
                        'mimetype' => 'image/jpeg',
                    ],
                ],
            ],
        ];

        $data = MessageUpsertData::fromWebhook($payload);

        $this->assertEquals('Foto do produto', $data->caption);
        $this->assertEquals('Foto do produto', $data->getContent());
    }

    private function getFixture(string $name): array
    {
        return json_decode(
            file_get_contents(base_path("tests/Fixtures/webhook-payloads/{$name}")),
            true
        );
    }
}
```

### Testes de Feature

```php
// tests/Feature/Evolution/WhatsappInstanceResourceTest.php
namespace Tests\Feature\Evolution;

use App\Filament\Resources\WhatsappInstances\WhatsappInstanceResource;
use App\Filament\Resources\WhatsappInstances\Pages\ListWhatsappInstances;
use App\Models\WhatsappInstance;
use Filament\Actions\DeleteAction;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class WhatsappInstanceResourceTest extends TestCase
{
    #[Test]
    public function it_can_render_list_page(): void
    {
        $this->get(WhatsappInstanceResource::getUrl('index'))
            ->assertSuccessful();
    }

    #[Test]
    public function it_can_list_instances(): void
    {
        $instances = WhatsappInstance::factory()->count(3)->create();

        Livewire::test(ListWhatsappInstances::class)
            ->assertCanSeeTableRecords($instances);
    }

    #[Test]
    public function it_can_create_instance(): void
    {
        // Mock da API Evolution
        Http::fake([
            '*/instance/create' => Http::response([
                'instance' => ['instanceId' => 'uuid-123', 'status' => 'created'],
                'hash' => 'abc123',
                'qrcode' => ['base64' => 'data:image/png;base64,...'],
            ]),
        ]);

        Livewire::test(CreateWhatsappInstance::class)
            ->fillForm([
                'name' => 'nova-instancia',
                'number' => '5511999999999',
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('whatsapp_instances', [
            'name' => 'nova-instancia',
        ]);
    }
}

// tests/Feature/Evolution/WebhookControllerTest.php
namespace Tests\Feature\Evolution;

use App\Jobs\Evolution\ProcessWebhookJob;
use App\Models\WhatsappInstance;
use Illuminate\Support\Facades\Queue;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class WebhookControllerTest extends TestCase
{
    #[Test]
    public function it_queues_webhook_for_processing(): void
    {
        Queue::fake();

        $response = $this->postJson('/api/evolution/webhook', [
            'event' => 'connection.update',
            'instance' => 'test-instance',
            'data' => ['state' => 'open'],
        ]);

        $response->assertOk();
        Queue::assertPushed(ProcessWebhookJob::class);
    }

    #[Test]
    public function it_processes_connection_update(): void
    {
        $instance = WhatsappInstance::factory()->create([
            'name' => 'test-instance',
            'status' => 'connecting',
        ]);

        $job = new ProcessWebhookJob('connection.update', [
            'instance' => 'test-instance',
            'data' => ['state' => 'open'],
        ]);

        $job->handle();

        $this->assertEquals('open', $instance->fresh()->status->value);
    }

    #[Test]
    public function it_processes_qrcode_updated(): void
    {
        $instance = WhatsappInstance::factory()->create([
            'name' => 'test-instance',
        ]);

        $job = new ProcessWebhookJob('qrcode.updated', [
            'instance' => 'test-instance',
            'data' => [
                'qrcode' => [
                    'base64' => 'data:image/png;base64,abc123',
                    'pairingCode' => 'ABCD1234',
                ],
            ],
        ]);

        $job->handle();

        $instance->refresh();
        $this->assertNotNull($instance->qr_code);
        $this->assertEquals('ABCD1234', $instance->pairing_code);
    }

    #[Test]
    public function it_logs_webhook_to_database(): void
    {
        $instance = WhatsappInstance::factory()->create(['name' => 'test']);

        $job = new ProcessWebhookJob('connection.update', [
            'instance' => 'test',
            'data' => ['state' => 'open'],
        ]);

        $job->handle();

        $this->assertDatabaseHas('whatsapp_webhooks', [
            'event' => 'connection.update',
            'processed' => true,
        ]);
    }
}

// tests/Feature/Evolution/SendMessageTest.php
namespace Tests\Feature\Evolution;

use App\Data\Evolution\MessageData;
use App\Jobs\Evolution\SendMessageJob;
use App\Models\WhatsappInstance;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SendMessageTest extends TestCase
{
    #[Test]
    public function it_sends_text_message(): void
    {
        Http::fake([
            '*/message/sendText/*' => Http::response([
                'key' => ['id' => 'msg-123', 'remoteJid' => '5511@s.whatsapp.net'],
                'status' => 'PENDING',
            ]),
        ]);

        $instance = WhatsappInstance::factory()->create(['status' => 'open']);
        $message = new MessageData(
            number: '5511999999999',
            content: 'Olá, teste!',
        );

        $job = new SendMessageJob($instance, $message);
        $job->handle(app(\App\Services\Evolution\Message\SendMessageEvolutionService::class));

        $this->assertDatabaseHas('whatsapp_messages', [
            'instance_id' => $instance->id,
            'phone' => '5511999999999',
            'content' => 'Olá, teste!',
            'direction' => 'outgoing',
        ]);
    }

    #[Test]
    public function it_retries_on_failure(): void
    {
        Http::fake([
            '*/message/sendText/*' => Http::response(['error' => 'timeout'], 500),
        ]);

        $instance = WhatsappInstance::factory()->create();
        $message = new MessageData(number: '5511999999999', content: 'Test');

        $job = new SendMessageJob($instance, $message);

        $this->expectException(\Exception::class);
        $job->handle(app(\App\Services\Evolution\Message\SendMessageEvolutionService::class));
    }
}
```

### Fixtures

```
tests/
└── Fixtures/
    └── webhook-payloads/
        ├── connection-update-open.json
        ├── connection-update-close.json
        ├── qrcode-updated.json
        ├── messages-upsert-text.json
        ├── messages-upsert-image.json
        └── send-message.json
```

```json
// tests/Fixtures/webhook-payloads/messages-upsert-text.json
{
    "event": "messages.upsert",
    "instance": "test-instance",
    "data": {
        "key": {
            "remoteJid": "5511999999999@s.whatsapp.net",
            "fromMe": false,
            "id": "BAE594145F4C59B4"
        },
        "messageType": "conversation",
        "message": {
            "conversation": "Olá, tudo bem?"
        },
        "messageTimestamp": "1717689097"
    }
}
```

---

## 📋 Checklist de Implementação

### Fase 0 - Setup do Package
- [ ] Criar estrutura do package (`packages/wallacemartinss/filament-evolution/`)
- [ ] Criar `composer.json` do package
- [ ] Criar `FilamentEvolutionServiceProvider.php`
- [ ] Criar `FilamentEvolutionPlugin.php` (Filament Panel Plugin)
- [ ] Criar `config/filament-evolution.php` com todas as configurações
- [ ] Publicar config via Service Provider

### Fase 1 - Multi-Tenancy e Infraestrutura Base
- [ ] Criar Traits
  - [ ] `src/Models/Concerns/HasTenant.php`
  - [ ] `src/Database/Migrations/Concerns/HasTenantColumn.php`
- [ ] Criar Migrations com tenant dinâmico
  - [ ] `create_whatsapp_instances_table.php`
  - [ ] `create_whatsapp_messages_table.php`
  - [ ] `create_whatsapp_webhooks_table.php`
- [ ] Criar Models com HasTenant
  - [ ] `WhatsappInstance.php`
  - [ ] `WhatsappMessage.php`
  - [ ] `WhatsappWebhook.php`
- [ ] Testes de Multi-Tenancy

### Fase 2 - DTOs (Data Transfer Objects)
- [ ] Instalar `spatie/laravel-data`
- [ ] Criar DTOs (`src/Data/`)
  - [ ] `InstanceData.php`
  - [ ] `MessageData.php`
  - [ ] `QrCodeData.php`
  - [ ] `ContactData.php`
  - [ ] `Webhook/ConnectionUpdateData.php`
  - [ ] `Webhook/QrCodeUpdatedData.php`
  - [ ] `Webhook/MessageUpsertData.php`
- [ ] Testes unitários de DTOs

### Fase 3 - Eventos, Jobs e Listeners
- [ ] Criar Events (`src/Events/`)
  - [ ] `InstanceConnected.php`
  - [ ] `InstanceDisconnected.php`
  - [ ] `MessageReceived.php`
  - [ ] `MessageSent.php`
  - [ ] `QrCodeUpdated.php`
- [ ] Criar Jobs (`src/Jobs/`)
  - [ ] `ProcessWebhookJob.php`
  - [ ] `SendMessageJob.php`
  - [ ] `SendBulkMessagesJob.php`
- [ ] Criar Listeners (`src/Listeners/`)
  - [ ] `UpdateInstanceStatus.php`
  - [ ] `LogMessageReceived.php`
  - [ ] `NotifyMessageReceived.php`
- [ ] Registrar Events/Listeners no Service Provider
- [ ] Testes de Jobs e Listeners

### Fase 4 - Enums
- [ ] Criar novos Enums (`src/Enums/`)
  - [ ] `StatusConnectionEnum.php`
  - [ ] `WebhookEventEnum.php`
  - [ ] `MessageTypeEnum.php`
  - [ ] `MessageDirectionEnum.php`
  - [ ] `MessageStatusEnum.php`
- [ ] Criar Migrations
  - [ ] `create_whatsapp_messages_table.php`
  - [ ] `create_whatsapp_webhooks_table.php`
- [ ] Criar Models
  - [ ] `WhatsappMessage.php`
  - [ ] `WhatsappWebhook.php`
- [ ] Factories para os novos Models
- [ ] Testes dos Models

### Fase 5 - Refatorar WebhookController
- [ ] Usar DTOs em vez de arrays raw
- [ ] Dispatch Job ao invés de processar inline
- [ ] Disparar Events para extensibilidade
- [ ] Adicionar logging estruturado
- [ ] Testes de integração de webhooks

### Fase 6 - Filament UI
- [ ] Criar `WhatsappInstanceResource` no plugin
- [ ] Criar `EvolutionQrCode` Livewire Component
- [ ] Adicionar Widget de estatísticas
- [ ] Adicionar página de logs de webhooks
- [ ] Testes de Feature do Resource

### Fase 7 - Services
- [ ] Criar `EvolutionClient` (HTTP Client)
- [ ] Criar Instance Services (Create, Connect, Delete, etc.)
- [ ] Criar Message Services (SendText, SendMedia, etc.)
- [ ] Testes de envio de mensagens

### Fase 8 - Polimento
- [ ] Traduções (pt_BR, en)
- [ ] Documentação (README.md)
- [ ] Cache de status de instâncias
- [ ] Logging estruturado
- [ ] GitHub Actions CI/CD
- [ ] Publicar no Packagist

---

## 📊 Resumo de Arquivos

### Código Existente (🟢 Referência do seu projeto)
| Arquivo | Descrição |
|---------|-----------|
| `WhatsappInstance` Model | UUID, name, number, status, settings |
| `StatusConnectionEnum` | CLOSE/OPEN/CONNECTING/REFUSED |
| `EvolutionClientTrait` | HTTP client com makeRequest() |
| 6 Instance Services | Create, Connect, Delete, Fetch, LogOut, Restart |
| `SendMessageEvolutionService` | Envio de mensagens texto |
| `EvolutionWebhookController` | Handler de webhooks |
| `EvolutionQrCode` Livewire | Componente QR com polling |
| `WhatsappInstanceResource` | Filament Resource completo |

### Novos Arquivos do Plugin (🔵 Criar)
| Arquivo | Descrição |
|---------|-----------|
| `config/filament-evolution.php` | Config completa (API, webhook, tenancy, etc.) |
| 4 DTOs Core | InstanceData, MessageData, QrCodeData, ContactData |
| 3 DTOs Webhook | ConnectionUpdateData, QrCodeUpdatedData, MessageUpsertData |
| 5 Events | InstanceConnected, InstanceDisconnected, MessageReceived, MessageSent, QrCodeUpdated |
| 3 Jobs | ProcessWebhookJob, SendMessageJob, SendBulkMessagesJob |
| 3 Listeners | UpdateInstanceStatus, LogMessageReceived, NotifyMessageReceived |
| 4 Enums | WebhookEventEnum, MessageTypeEnum, MessageDirectionEnum, MessageStatusEnum |
| 3 Migrations | whatsapp_instances, whatsapp_messages, whatsapp_webhooks (com tenant dinâmico) |
| 2 Models | WhatsappMessage, WhatsappWebhook (com HasTenant trait) |
| 2 Traits | HasTenant (model), HasTenantColumn (migration) |
| 1 Config | config/filament-evolution.php |
| 47+ Testes | Unit + Feature com fixtures |

### Total Estimado
- **Arquivos existentes**: ~15 arquivos
- **Novos arquivos**: ~35 arquivos
- **Total de testes**: 47+ casos de teste

---

## 📝 Notas Importantes

1. **Segurança do Webhook**: Sempre validar a origem do webhook usando secret/signature
2. **Rate Limiting**: A Evolution API pode ter limites, implementar retry com backoff
3. **Queue**: Webhooks e envios devem ser processados em background
4. **Soft Deletes**: Instâncias usam soft delete para manter histórico
5. **Multi-tenancy**: ✅ Suporte completo via `config('filament-evolution.tenancy')`
6. **Config Própria**: ✅ Plugin usa `config/filament-evolution.php` (não `services.php`)
