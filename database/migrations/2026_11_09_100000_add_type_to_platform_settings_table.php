<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Extend the existing platform_settings table instead of creating a
     * duplicate site_settings table. `type` lets the admin module keep
     * booleans, colours, files and text distinct for validation/UI purposes.
     */
    public function up(): void
    {
        if (! Schema::hasTable('platform_settings')) {
            return;
        }

        if (! Schema::hasColumn('platform_settings', 'type')) {
            Schema::table('platform_settings', function (Blueprint $table) {
                $table->string('type', 20)->default('string')->after('value');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('platform_settings') && Schema::hasColumn('platform_settings', 'type')) {
            Schema::table('platform_settings', function (Blueprint $table) {
                $table->dropColumn('type');
            });
        }
    }
};
