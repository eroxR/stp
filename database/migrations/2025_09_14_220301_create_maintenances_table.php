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
        Schema::create('maintenances', function (Blueprint $table) { //tabla de mantenimientos
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles')->comment('{id_vehiculo} relación con la tabla vehículos');
            $table->foreignId('usuario_id')->nullable()->constrained('users')->comment('{id_usuario} relación con la tabla usuarios, con la empresa asociada');
            $table->string('maintenance_provider', 100)->nullable()->comment('{proveedor_mantenimiento} nombre del proveedor del mantenimiento');
            $table->timestamp('maintenance_date')->nullable()->comment('{fecha_mantenimiento} fecha del mantenimiento');
            $table->string('mileage', 20)->nullable()->comment('{kilometraje} kilometraje del vehículo al momento del mantenimiento');
            $table->enum('type_maintenance', ['1', '2'])->nullable()->comment('{tipo_mantenimiento} tipo de mantenimiento["Preventivo","Correctivo"]');
            $table->text('description')->nullable()->comment('{descripcion} descripción del mantenimiento realizado');
            $table->foreignId('company_id')->constrained('companies')->comment('{id_compañia} relación con la tabla empresas');
            $table->string('code_company')->comment('{codigo_compañia} relación con la tabla empresas');
            $table->foreignId('branch_id')->constrained('branches')->comment('{id_sucursal} relación con la tabla sucursales');
            $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible del mantenimiento ante el uso de los usuarios (visible/invisible)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
