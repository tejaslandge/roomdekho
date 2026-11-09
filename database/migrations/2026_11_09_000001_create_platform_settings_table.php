<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('platform_settings')) {
            return;
        }

        Schema::create('platform_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key', 100)->unique();
            $table->text('value')->nullable();
            $table->string('group', 50)->default('general');
            $table->timestamps();
        });

        $now = now();

        DB::table('platform_settings')->insert([
            ['key' => 'site_name', 'value' => 'RoomDekho', 'group' => 'general', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'support_email', 'value' => 'support@roomdekho.test', 'group' => 'general', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'commission_rate', 'value' => '10', 'group' => 'general', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'currency', 'value' => 'INR', 'group' => 'general', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'maintenance_mode', 'value' => '0', 'group' => 'general', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('platform_settings');
    }
};
