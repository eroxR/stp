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
        Schema::create('license_categories', function (Blueprint $table) { //tabla categorias de licencias de conduccion
            $table->id();
            $table->string('code_licensecategory', 4)->unique()->comment('{codigo_categoria_licencia} codigo de la categoria de la licencia de conduccion');
            $table->string('description_licensecategory', 120)->comment('{descripcion_categoria_licencia} descripcion nombre de la categoria de la licencia de conduccion');
            $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible de la categoria de la licencia de conduccion ante el uso de los usuarios (visible/invisible)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('license_categories');
    }
};
