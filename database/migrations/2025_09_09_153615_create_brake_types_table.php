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
        Schema::create('brake_types', function (Blueprint $table) { //tipos de frenos que usa el vehiculo
            $table->id();
            $table->string('brake_type_description', 120)->comment('{descripcion_tipo_freno} descripción del tipos de frenos que usa el vehiculo');
            // $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible del tipo de freno ante el uso de las compañias (visible/invisible)');
            $table->json('company_view')->nullable()->comment('{visibilidad_empresa} array de empresas a las cuales el tipo de freno no es visible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brake_types');
    }
};
