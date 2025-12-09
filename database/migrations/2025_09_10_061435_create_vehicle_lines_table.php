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
        Schema::create('vehicle_lines', function (Blueprint $table) { //tabla lineas de vehículos
            $table->id();
            $table->string('brand_vehicle', 60)->comment('{codigo_marca_vehiculo} marca comercial del vehículo');
            $table->string('line_vehicle', 60)->comment('{Linea_vehiculo} nombre o codigo de la linea del vehículo');
            $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible de la linea del vehiculo ante el uso de los usuarios (visible/invisible)');
            $table->timestamps();

            $table->foreign('brand_vehicle') // La columna en ESTA tabla.
                ->references('code_brand_vehicle') // La columna en la OTRA tabla.
                ->on('vehicle_brands') // El nombre de la OTRA tabla.
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_lines');
    }
};
