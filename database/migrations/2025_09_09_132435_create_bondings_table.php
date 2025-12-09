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
            $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible del tipo de vinculación ante el uso de los usuarios (visible/invisible)');
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
