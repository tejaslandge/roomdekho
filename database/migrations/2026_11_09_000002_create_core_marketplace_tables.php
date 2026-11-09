<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Core marketplace schema. Each table is guarded so this migration is a
     * no-op on databases that were provisioned from the original SQL dump.
     */
    public function up(): void
    {
        if (! Schema::hasTable('properties')) {
            Schema::create('properties', function (Blueprint $table) {
                $table->id();
                $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete();
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('city', 150);
                $table->string('area', 150);
                $table->text('address');
                $table->decimal('latitude', 10, 7)->nullable();
                $table->decimal('longitude', 10, 7)->nullable();
                $table->enum('status', ['active', 'inactive'])->default('active');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('property_images')) {
            Schema::create('property_images', function (Blueprint $table) {
                $table->id();
                $table->foreignId('property_id')->constrained('properties')->cascadeOnDelete();
                $table->string('image_path');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('rooms')) {
            Schema::create('rooms', function (Blueprint $table) {
                $table->id();
                $table->foreignId('property_id')->constrained('properties')->cascadeOnDelete();
                $table->string('room_type');
                $table->decimal('rent', 10, 2);
                $table->text('description')->nullable();
                $table->boolean('available')->default(true);
                $table->boolean('temporary_allowed')->default(false);
                $table->integer('min_days')->nullable();
                $table->integer('max_days')->nullable();
                $table->string('electricity_type')->nullable();
                $table->string('water_source')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('room_images')) {
            Schema::create('room_images', function (Blueprint $table) {
                $table->id();
                $table->foreignId('room_id')->constrained('rooms')->cascadeOnDelete();
                $table->string('image_path');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('amenities')) {
            Schema::create('amenities', function (Blueprint $table) {
                $table->id();
                $table->string('name', 100);
                $table->string('icon')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('room_amenities')) {
            Schema::create('room_amenities', function (Blueprint $table) {
                $table->id();
                $table->foreignId('room_id')->constrained('rooms')->cascadeOnDelete();
                $table->foreignId('amenity_id')->constrained('amenities')->cascadeOnDelete();
            });
        }

        if (! Schema::hasTable('favourites')) {
            Schema::create('favourites', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->foreignId('room_id')->constrained('rooms')->cascadeOnDelete();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('bookings')) {
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
        }

        if (! Schema::hasTable('payments')) {
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
        }

        if (! Schema::hasTable('agreements')) {
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
        }

        if (! Schema::hasTable('conversations')) {
            Schema::create('conversations', function (Blueprint $table) {
                $table->id();
                $table->foreignId('room_id')->constrained('rooms');
                $table->foreignId('owner_id')->constrained('users');
                $table->foreignId('tenant_id')->constrained('users');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('messages')) {
            Schema::create('messages', function (Blueprint $table) {
                $table->id();
                $table->foreignId('conversation_id')->constrained('conversations')->cascadeOnDelete();
                $table->foreignId('sender_id')->constrained('users');
                $table->text('message');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('notifications')) {
            Schema::create('notifications', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users');
                $table->string('title');
                $table->text('message');
                $table->boolean('is_read')->default(false);
                $table->timestamp('created_at')->nullable();
            });
        }

        if (! Schema::hasTable('maintenance_requests')) {
            Schema::create('maintenance_requests', function (Blueprint $table) {
                $table->id();
                $table->foreignId('room_id')->constrained('rooms');
                $table->foreignId('tenant_id')->constrained('users');
                $table->string('title');
                $table->text('description');
                $table->enum('status', ['pending', 'in_progress', 'resolved'])->default('pending');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('rent_histories')) {
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

        if (! Schema::hasTable('user_verifications')) {
            Schema::create('user_verifications', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users');
                $table->enum('id_type', ['aadhaar', 'pan', 'driving_license']);
                $table->string('id_number', 100);
                $table->string('id_image');
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
                $table->text('rejection_reason')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        // Never drop marketplace data from a shared database.
    }
};
