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
        Schema::create('product_and_services', function (Blueprint $table) { //tabla de productos y servicios
            $table->id();
            $table->string('productandservice_description', 120)->comment('{descripcion_productoyservicio} descripción del tipo de producto y servicio');
            $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible del producto y servicio ante el uso de los usuarios (visible/invisible)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_and_services');
    }
};
