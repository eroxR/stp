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
        Schema::create('vehicle_brands', function (Blueprint $table) { //marcas de vehiculo
            $table->id();
            $table->string('code_brand_vehicle', 60)->unique()->comment('{codigo_marca_vehiculo} codigo de la marca comercial del vehículo');
            $table->string('brand_vehicle', 60)->comment('{marca_vehiculo} nombre de la marca comercial del vehículo');
            // $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible de la marca del vehículo ante el uso de las compañias (visible/invisible)');
            $table->json('company_view')->nullable()->comment('{visibilidad_empresa} array de empresas a las cuales la marca del vehículo no es visible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_brands');
    }
};
