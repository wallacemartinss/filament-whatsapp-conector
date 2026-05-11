<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('whatsapp_instances')) {
            return;
        }

        if (Schema::hasColumn('whatsapp_instances', 'qr_code_updated_at')) {
            return;
        }

        Schema::table('whatsapp_instances', function (Blueprint $table) {
            $table->timestamp('qr_code_updated_at')->nullable()->after('qr_code');
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('whatsapp_instances')) {
            return;
        }

        if (! Schema::hasColumn('whatsapp_instances', 'qr_code_updated_at')) {
            return;
        }

        Schema::table('whatsapp_instances', function (Blueprint $table) {
            $table->dropColumn('qr_code_updated_at');
        });
    }
};
