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
        Schema::create('resource_documents', function (Blueprint $table) { //tabla documentos de recursos
            $table->id();
            $table->string('name_document')->comment('{nombre_documento} nombre del documento');
            // $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible del documento del recurso o persona ante el uso de las compañias (visible/invisible)');
            $table->json('company_view')->nullable()->comment('{visibilidad_empresa} array de empresas a las cuales el documento del recurso o persona no es visible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resource_documents');
    }
};
