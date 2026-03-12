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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained('properties')->onDelete('cascade');
            $table->enum('room_type', ['single', '1bhk', '2bhk', 'pg']);
            $table->decimal('rent', 10, 2);
            $table->boolean('available')->default(true);
            $table->boolean('temporary_allowed')->default(false);
            $table->integer('min_days')->nullable();
            $table->integer('max_days')->nullable();
            $table->enum('electricity_type', ['meter', 'fixed'])->nullable();
            $table->enum('water_source', ['borewell', 'municipal'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
