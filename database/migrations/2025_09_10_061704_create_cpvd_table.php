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
        Schema::create('cpvd', function (Blueprint $table) { //tabla de contratos, permisos, vehículos y conductores
            $table->id();

            $table->foreignId('order_id')->nullable()->constrained('orders')->comment('{id_orden} relación con la tabla órdenes');
            $table->foreignId('contract_id')->nullable()->constrained('contracts')->comment('{id_contrato} relación con la tabla contratos');
            $table->foreignId('vehicle_id')->nullable()->constrained('vehicles')->comment('{id_vehiculo} relación con la tabla vehículos');
            $table->foreignId('permit_id')->nullable()->constrained('permits')->comment('{id_permiso} relación con la tabla permisos');
            $table->foreignId('user_id')->nullable()->constrained('users')->comment('{id_conductor} relación con la tabla conductores');
            $table->foreignId('accident_id')->nullable()->constrained('accidents')->comment('{id_accidente} relación con la tabla accidentes');
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
        Schema::dropIfExists('cpvd');
    }
};
