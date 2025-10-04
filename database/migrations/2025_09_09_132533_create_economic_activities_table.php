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
        Schema::create('economic_activities', function (Blueprint $table) {//tabla Actividades Economicas
            $table->id();
            $table->integer('EconomicActivity_number')->comment('{codigo_actividad_economica} codigo de la Actividad Economica');
			$table->string('description_EconomicActivity')->comment('{descripcion_actividad_economica} descripcion de la Actividad Economica');
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
