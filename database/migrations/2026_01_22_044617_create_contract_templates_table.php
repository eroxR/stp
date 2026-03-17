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
        Schema::create('contract_templates', function (Blueprint $table) { // tabla plantillas de contrato
            $table->id();

            $table->string('template_code', 50)->comment('{codigo_plantilla} codigo identificador unico de la plantilla del contrato (A,B,C,D,E,F, etc)');
            $table->string('template_name', 100)->comment('{nombre_plantilla} nombre identificador de la plantilla del contrato');
            // $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible de la plantilla del contrato ante el uso de las compañias (visible/invisible)');
            $table->json('company_view')->nullable()->comment('{visibilidad_empresa} array de empresas a las cuales la plantilla del contrato no es visible');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_templates');
    }
};
