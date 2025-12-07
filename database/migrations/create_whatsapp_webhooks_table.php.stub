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
        Schema::create('whatsapp_webhooks', function (Blueprint $table) {
            $table->id();

            // Dynamic tenant column based on config
            $this->addTenantColumn($table);

            $table->foreignUuid('instance_id')
                ->nullable()
                ->constrained('whatsapp_instances')
                ->nullOnDelete();

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

    public function down(): void
    {
        Schema::dropIfExists('whatsapp_webhooks');
    }
};
