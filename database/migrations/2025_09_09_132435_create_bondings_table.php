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
        Schema::create('bondings', function (Blueprint $table) { //tabla tipos de vinculacion
            $table->id();
            $table->string('bonding_type_description', 120)->comment('{descripcion_tipo_vinculacion} descripcion tipo Vinculacion o contrato');
            // $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible del tipo de vinculación ante el uso de las compañias (visible/invisible)');
            $table->json('company_view')->nullable()->comment('{visibilidad_empresa} array de empresas a las cuales el tipo de vinculación no es visible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bondings');
    }
};
