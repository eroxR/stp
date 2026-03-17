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
        Schema::create('alert_statuses', function (Blueprint $table) { // tabla estados de alertas
            $table->id();
            $table->integer('code')->comment('{codigo} codigo del nombre del estado de la alerta ("Nueva", "En Progreso", "Resuelta", "Archivada"))');
            $table->string('name', 20)->comment('{nombre} nombre del estado de la alerta ("Nueva","Resuelta", "Archivada", "Eliminada")');
            $table->string('icon_description', 100)->nullable()->comment('{icono_descripcion} descripcion del estado de la alerta');
            $table->text('description')->nullable()->comment('{descripcion} descripcion del estado de la alerta');
            // $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible del estado de la alerta ante el uso de las compañias (visible/invisible)');
            $table->json('company_view')->nullable()->comment('{visibilidad_empresa} array de empresas a las cuales el estado de la alerta no es visible');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alert_statuses');
    }
};
