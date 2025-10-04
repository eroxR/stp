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
        Schema::create('dimension_rims', function (Blueprint $table) {//tabla de las dimensiones de las llantas
            $table->id();
            $table->string('type_rims', 120)->comment('{nomeclatura_tipo_llanta} nomeclatura del tipo de llantas que usa el vehiculo');
            $table->string('inch', 120)->comment('{pulgada_tipo_llanta} pulgada del tipo de llantas que usa el vehiculo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dimension_rims');
    }
};
