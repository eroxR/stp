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
        Schema::create('educational_levels', function (Blueprint $table) { //tabla niveles educativos
            $table->id();
            $table->string('description_leveleducation', 45)->comment('{descripcion_nivel_educativo} descripcion nombre del nivel Educativo');
            $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible del nivel educativo ante el uso de los usuarios (visible/invisible)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educational_levels');
    }
};
