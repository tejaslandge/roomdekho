<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
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

        Schema::create('room_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained('rooms')->cascadeOnDelete();
            $table->string('image_path');
            $table->timestamps();
        });

        Schema::create('room_amenities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained('rooms')->cascadeOnDelete();
            $table->foreignId('amenity_id')->constrained('amenities')->cascadeOnDelete();
        });

        Schema::create('favourites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('room_id')->constrained('rooms')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favourites');
        Schema::dropIfExists('room_amenities');
        Schema::dropIfExists('room_images');
        Schema::dropIfExists('rooms');
    }
};
