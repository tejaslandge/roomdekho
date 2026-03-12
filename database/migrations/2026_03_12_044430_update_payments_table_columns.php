<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'payment_status']);
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->enum('payment_method', ['upi', 'card', 'cash'])->after('amount');
            $table->enum('payment_status', ['pending', 'completed', 'failed'])->default('pending')->after('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'payment_status']);
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->enum('payment_method', ['online', 'offline']);
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
        });
    }
};
