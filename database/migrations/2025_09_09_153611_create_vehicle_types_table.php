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
        Schema::create('vehicle_types', function (Blueprint $table) { //tabla tipos o clases de Vehiculos
            $table->id();
            $table->string('vehicle_type_name', 120)->comment('{nombre_tipo_clase_vehiculo} nombre del tipo o clase del Vehiculo');
            // $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible del tipo del vehiculo ante el uso de las compañias (visible/invisible)');
            $table->json('company_view')->nullable()->comment('{visibilidad_empresa} array de empresas a las cuales el tipo del vehiculo no es visible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_types');
    }
};
