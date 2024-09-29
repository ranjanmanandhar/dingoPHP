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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('license_plate')->unique();
            $table->foreignId('state_id')->constrained('states')->onDelete('cascade'); // Foreign key to states table
            $table->string('vin')->unique();
            $table->year('year');
            $table->string('colour');
            $table->foreignId('make_id')->constrained('cars_make')->onDelete('cascade'); // Foreign key to makes table
            $table->foreignId('model_id')->constrained('models')->onDelete('cascade'); // Foreign key to models table
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
