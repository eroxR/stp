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
        Schema::create('inspection_categories', function (Blueprint $table) { //tabla de categorías de inspección
            $table->id();
            $table->string('name_description')->comment('{descripcion_nombre} nombre o descripción de la categoría de inspección');
            // $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible de la categoría de inspección ante el uso de las compañias (visible/invisible)');
            $table->json('company_view')->nullable()->comment('{visibilidad_empresa} array de empresas a las cuales la categoría de inspección no es visible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection_categories');
    }
};
