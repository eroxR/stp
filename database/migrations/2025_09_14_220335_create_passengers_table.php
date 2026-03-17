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
        Schema::create('passengers', function (Blueprint $table) { //tabla de pasajeros
            $table->id();
            $table->foreignId('identification')->constrained('identifications')->comment('{identificacion} identificación del pasajero');
            $table->bigInteger('identificationcard_passenger')->comment('{cedula_pasajero} cédula del pasajero');
            $table->string('names_lastnames')->comment('{nombres_apellidos} nombres y apellidos del pasajero');
            $table->foreignId('contract_id')->constrained('contracts')->comment('{contrato} relación con la tabla contratos');
            $table->foreignId('company_id')->constrained('companies')->comment('{id_compañia} relación con la tabla empresas');
            $table->string('code_company')->comment('{codigo_compañia} relación con la tabla empresas');
            $table->foreignId('branch_id')->constrained('branches')->comment('{id_sucursal} relación con la tabla sucursales');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passengers');
    }
};
