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
        Schema::create('inspections', function (Blueprint $table) {//tabla de inspecciones
            $table->id();
            $table->string('name_description')->comment('{descripcion_nombre} nombre o descripción de la inspección');
            $table->foreignId('category_id')->constrained('inspection_categories')->comment('{id_categoria} id de la categoría de inspección');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspections');
    }
};
