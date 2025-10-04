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
        Schema::create('work_areas', function (Blueprint $table) {//Areas de Trabajo
            $table->id();
            $table->string('workarea_description', 120)->comment('{descripcion_area_trabajo} descripcion area de Trabajo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_areas');
    }
};
