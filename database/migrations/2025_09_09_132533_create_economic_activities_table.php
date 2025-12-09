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
        Schema::create('economic_activities', function (Blueprint $table) { //tabla Actividades Economicas
            $table->id();
            $table->string('economicactivity_number')->unique()->comment('{codigo_actividad_economica} codigo de la Actividad Economica');
            $table->string('description_economicactivity')->comment('{descripcion_actividad_economica} descripcion de la Actividad Economica');
            $table->string('category_id')->comment('{categoria_id} división de la categoria de la Actividad Economica');
            $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible de la Actividad Economica ante el uso de los usuarios (visible/invisible)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('economic_activities');
    }
};
