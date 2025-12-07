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
        Schema::create('whatsapp_instances', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Dynamic tenant column based on config
            $this->addTenantColumn($table);

            $table->string('name');
            $table->string('number');
            $table->string('instance_id')->nullable();
            $table->string('profile_picture_url')->nullable();
            $table->string('status')->nullable();
            $table->boolean('reject_call')->default(false);
            $table->string('msg_call')->nullable();
            $table->boolean('groups_ignore')->default(false);
            $table->boolean('always_online')->default(false);
            $table->boolean('read_messages')->default(false);
            $table->boolean('read_status')->default(false);
            $table->boolean('sync_full_history')->default(false);
            $table->string('count')->nullable();
            $table->string('pairing_code')->nullable();
            $table->longText('qr_code')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('name');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('whatsapp_instances');
    }
};
