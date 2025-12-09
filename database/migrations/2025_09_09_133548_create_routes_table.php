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
        Schema::create('routes', function (Blueprint $table) { // Rutas de origen y destino
            $table->id();
            $table->string('name_route')->unique()->comment('{nombre_ruta} nombre de la ruta para el Origen o Destino del viaje');
            $table->string('description_route')->nullable()->comment('{descripcion_ruta} descripción de la ruta para el origen o destino del viaje');
            $table->enum('type_route', ['O', 'D', 'A'])->comment('{tipo_ruta} Tipo de ruta para el viaje ["Origen","Destino","Ambos"]');
            $table->foreignId('company_id')->constrained('companies')->comment('{id_compañia} relación con la tabla empresas');
            $table->string('code_company')->comment('{codigo_compañia} relación con la tabla empresas');
            $table->foreignId('branch_id')->constrained('branches')->comment('{id_sucursal} relación con la tabla sucursales');
            $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible de la ruta ante el uso de los usuarios (visible/invisible)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
