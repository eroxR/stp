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
        Schema::create('permits', function (Blueprint $table) {//tabla de permisos o fuec
            $table->id();

            $table->foreignId('contract')->constrained('contracts')->comment('{id_contrato} relación con la tabla contratos');
            $table->date('permit_start_date')->comment('{fecha_inicio_permiso} fecha de inicio del FUEC');
            $table->date('permit_end_date')->comment('{fecha_fin_permiso} fecha de finalización del FUEC');
            $table->integer('permit_number')->comment('{numero_consecuente_permiso} número consecutivo del permiso o FUEC dentro del contrato');
            $table->string('permit_code', 30)->comment('{codigo_unico_permiso} código único del permiso o FUEC');
            $table->enum('fuec_status', ['1', '2', '3', '4', '5'])->default('1')->comment('{estado_permiso}["INICIAL","EN CURSO","PENDIENTE","FINALIZADO","CANCELADO"])->default("INICIAL");');
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
        Schema::dropIfExists('permits');
    }
};
