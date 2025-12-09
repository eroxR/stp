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
        Schema::create('contract_types', function (Blueprint $table) { //tipo contratos
            $table->id();
            $table->string('description_typecontract', 120)->nullable()->comment('{descripcion_tipoContrato} descripción del tipo de contrato');
            $table->string('contract_name', 120)->comment('{nombre_contrato} nombre del tipo de contrato');
            $table->bigInteger('start_contract')->nullable()->comment('{inicio_contrato} numero inicial del numero del contrato');
            $table->bigInteger('contract_limit')->nullable()->comment('{limite_contrato} numero final limitante del numero del contrato');
            $table->foreignId('company_id')->constrained('companies')->comment('{id_compañia} relación con la tabla empresas');
            $table->string('code_company')->comment('{codigo_compañia} relación con la tabla empresas');
            $table->foreignId('branch_id')->constrained('branches')->comment('{id_sucursal} relación con la tabla sucursales');
            $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible del tipo de contrato ante el uso de los usuarios (visible/invisible)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_types');
    }
};
