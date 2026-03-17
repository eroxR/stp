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
        Schema::create('documents', function (Blueprint $table) { //tabla de documentos
            $table->id();

            $table->unsignedBigInteger('documentable_id')->comment('{id_relación_tabla} id del modelo al que pertenece el documento');
            $table->string('document_name')->unique()->comment('{nombre_documento} nombre y llave unica del documento con la que verificamos el historial');
            $table->string('extension', 6)->comment('{extension} extensión del archivo');
            $table->text('directory')->comment('{directorio} directorio o ruta del documento en el servidor');
            $table->string('documentable_type')->comment('{documento_tipo_modelo_tabla} tipo del modelo al que pertenece el documento');
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
        Schema::dropIfExists('documents');
    }
};
