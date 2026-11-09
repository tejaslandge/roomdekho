<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained('rooms')->cascadeOnDelete();
            $table->foreignId('tenant_id')->constrained('users')->cascadeOnDelete();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->decimal('amount', 10, 2)->default(0);
            $table->enum('status', ['pending', 'active', 'cancelled'])->default('pending');
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->cascadeOnDelete();
            $table->decimal('amount', 10, 2);
            $table->enum('payment_method', ['upi', 'card', 'cash']);
            $table->enum('payment_status', ['pending', 'completed', 'failed'])->default('pending');
            $table->string('transaction_id')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });

        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings');
            $table->foreignId('owner_id')->constrained('users');
            $table->foreignId('tenant_id')->constrained('users');
            $table->string('file_path')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->enum('status', ['active', 'terminated', 'completed'])->default('active');
            $table->timestamps();
        });

        Schema::create('rent_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('users');
            $table->foreignId('room_id')->constrained('rooms');
            $table->foreignId('booking_id')->constrained('bookings');
            $table->decimal('amount', 10, 2);
            $table->enum('payment_method', ['online', 'offline']);
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rent_histories');
        Schema::dropIfExists('agreements');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('bookings');
    }
};
