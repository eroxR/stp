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
        Schema::create('shoe_sizes', function (Blueprint $table) { //tabla tallas de zapato
            $table->id();
            $table->string('description_shoesize', 120)->comment('{descripcion_talla_zapato} descripción de la talla de zapato');
            $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible de la talla de zapato ante el uso de los usuarios (visible/invisible)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shoe_sizes');
    }
};
