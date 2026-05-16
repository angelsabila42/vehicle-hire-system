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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id('VehicleId');
            $table->foreignId('pickup_location_id')
              ->nullable() 
              ->constrained('pickup_locations')
              ->onDelete('cascade');
            $table->string('number_plate')->unique();
            $table->string('make');
            $table->string('model');
            $table->year('year');
            $table->decimal('price_per_day', 10, 2);
            $table->string('status')->default('Available');
            $table->string('type');
            $table->string('location');
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
