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
        Schema::create('branches', function (Blueprint $table) { //sucursales
            $table->id();
            $table->string('code_branch')->comment('{codigo_sucursal} código de la sucursal');
            $table->string('name_branch')->comment('{nombre_sucursal} nombre de la sucursal');
            $table->string('address_branch')->nullable()->comment('{dire} dirección de la sucursal');
            $table->string('phone_branch')->nullable()->comment('{telefono_sucursal} teléfono de la sucursal');
            $table->string('email_branch')->nullable()->comment('{correo_sucursal} correo electrónico de la sucursal');
            $table->string('city_branch')->nullable()->comment('{ciudad_sucursal} ciudad de la sucursal');
            $table->string('province_branch')->nullable()->comment('{departamento_sucursal} estado/provincia/departamento de la sucursal');
            $table->string('country_branch')->nullable()->comment('{pais_sucursal} país de la sucursal');
            $table->string('postal_code_branch')->nullable()->comment('{codigo_postal_sucursal} código postal de la sucursal');
            $table->string('manager_branch')->nullable()->comment('{gerente_sucursal} gerente o encargado de la sucursal');
            $table->integer('number_employees_branch')->nullable()->comment('{numero_empleados_sucursal} número de empleados de la sucursal');
            $table->enum('status_branch',['1','0'])->default('1')->comment('{estado_sucursal} estado de la sucursal (activo/inactivo)');
            $table->foreignId('company_id')->constrained('companies')->comment('{id_compañia} relación con la tabla empresas');
            $table->string('code_company')->comment('{codigo_compañia} relación con la tabla empresas');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
