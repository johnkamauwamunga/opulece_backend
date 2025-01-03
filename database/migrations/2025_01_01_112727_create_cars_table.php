<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id');
            $table->string('make');
            $table->string('model');
            $table->date('year_made');
            $table->string('mileage');
            $table->enum('fuel_type', ['Petrol', 'Diesel', 'Electric', 'Hybrid'])->default('Petrol');
            $table->string('transmission');
            $table->string('description');
            $table->string('price');
            $table->enum('status', ['Available', 'Sold'])->default('Available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
