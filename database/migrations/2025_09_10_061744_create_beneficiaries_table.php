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
        Schema::create('beneficiaries', function (Blueprint $table) { //tabla de beneficiarios
            $table->id();

            $table->string('full_name', 100)->nullable()->comment('{nombre_completo} nombre completo del beneficiario');
            $table->string('identificationcard', 15)->nullable()->comment('{identificacion} documento de identidad del beneficiario');
            $table->enum('beneficiarytype', ['1', '2', '3'])->nullable()->comment('{tipo_beneficiario} tipo de beneficiario["Adulto mayor","Conyugue","Hijo o Hijastro"]');
            $table->foreignId('user_id')->constrained('users')->comment('{id_usuario} id del usuario al que pertenece el beneficiario');
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
        Schema::dropIfExists('beneficiaries');
    }
};
