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
        Schema::create('health_entities', function (Blueprint $table) { //tabla de las Eps o entidad de salud
            $table->id();
            $table->string('description_eps', 120)->comment('{descripcion_eps} descripcion nombre de la Eps');
            $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible de la Eps ante el uso de los usuarios (visible/invisible)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_entities');
    }
};
