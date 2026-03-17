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
        Schema::create('user_types', function (Blueprint $table) { //tabla tipos de usuario
            $table->id();
            $table->string('description_usertype', 120)->comment('{descripcion_tipo_usuario} descripción nombre del tipo de usuario');
            // $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible del tipo de usuario ante el uso de las compañias (visible/invisible)');
            $table->json('company_view')->nullable()->comment('{visibilidad_empresa} array de empresas a las cuales el tipo de usuario no es visible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_types');
    }
};
