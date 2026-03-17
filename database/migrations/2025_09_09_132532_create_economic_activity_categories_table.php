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
        Schema::create('economic_activity_categories', function (Blueprint $table) { //tabla categoria de la actividad economica
            $table->id();
            $table->string('division')->comment('{division} codigo de la categoria de la actividad económica');
            $table->string('groups')->comment('{grupo} codigo del grupo de la categoria de la actividad económica');
            $table->string('description')->comment('{descripcion} descripción o nombre de la categoría de actividad económica');
            // $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible de la categoría de actividad económica ante el uso de las compañias (visible/invisible)');
            $table->json('company_view')->nullable()->comment('{visibilidad_empresa} array de empresas a las cuales la categoria de la actividad economica no es visible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('economic_activity_categories');
    }
};
