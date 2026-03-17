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
        Schema::create('documentations', function (Blueprint $table) { //tabla documentaciones
            $table->id();
            $table->string('document_name')->comment('{nombre_documento} nombre del documento');
            $table->string('document_path')->comment('{ruta_documento} ruta del documento');
            $table->string('document_type')->comment('{tipo_documento} tipo de documento');
            $table->string('document_size')->nullable()->comment('{tamano_documento} tamaño del documento');
            $table->string('document_extension')->nullable()->comment('{extension_documento} extensión del documento');
            $table->string('document_description')->nullable()->comment('{descripcion_documento} descripción del documento');
            $table->foreignId('company_id')->constrained('companies')->comment('{id_compañia} relación con la tabla empresas');
            $table->string('code_company')->comment('{codigo_compañia} relación con la tabla empresas');
            $table->foreignId('branch_id')->constrained('branches')->comment('{id_sucursal} relación con la tabla sucursales');
            // $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible de la documentacion ante el uso de las compañias (visible/invisible)');
            $table->json('company_view')->nullable()->comment('{visibilidad_empresa} array de empresas a las cuales la documentacion no es visible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentations');
    }
};
