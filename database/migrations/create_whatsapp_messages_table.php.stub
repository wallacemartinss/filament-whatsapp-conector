<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use WallaceMartinss\FilamentEvolution\Database\Migrations\Concerns\HasTenantColumn;

return new class extends Migration
{
    use HasTenantColumn;

    public function up(): void
    {
        Schema::create('whatsapp_messages', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Dynamic tenant column based on config
            $this->addTenantColumn($table);

            $table->foreignUuid('instance_id')
                ->constrained('whatsapp_instances')
                ->cascadeOnDelete();

            $table->string('message_id')->index();
            $table->string('remote_jid');
            $table->string('phone');
            $table->string('direction'); // incoming, outgoing
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
            $table->index('direction');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('whatsapp_messages');
    }
};
