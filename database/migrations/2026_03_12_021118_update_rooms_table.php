<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            if (!Schema::hasColumn('rooms', 'description')) {
                $table->text('description')->nullable()->after('rent');
            }
            // Change enums to strings for flexibility
            $table->string('room_type')->change();
            $table->string('electricity_type')->nullable()->change();
            $table->string('water_source')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
};
