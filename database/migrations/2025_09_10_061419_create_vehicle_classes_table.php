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
        Schema::create('vehicle_classes', function (Blueprint $table) {//clases de vehiculos
            $table->id();
            $table->string('vehicle_class_description', 120)->comment('{descripcion_clase_vehiculo} descripcion de la clase de combustible que usa el vehiculo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_classes');
    }
};
