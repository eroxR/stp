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
        Schema::create('vehicle_brands', function (Blueprint $table) {//marcas de vehiculo
            $table->id();
            $table->string('code_brand_vehicle', 60)->unique()->comment('{codigo_marca_vehiculo} codigo de la marca comercial del vehículo');
            $table->string('brand_vehicle', 60)->comment('{marca_vehiculo} nombre de la marca comercial del vehículo');
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
