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
        Schema::create('compensation_boxes', function (Blueprint $table) { //cajas de compensacion
            $table->id();
            $table->string('description_compensationbox', 120)->comment('{descripcion_cajacompensacion} descripcion nombre de la caja de compensacion');
            $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible de la caja de compensacion ante el uso de los usuarios (visible/invisible)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compensation_boxes');
    }
};
