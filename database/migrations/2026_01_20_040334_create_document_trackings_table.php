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
        Schema::create('document_trackings', function (Blueprint $table) { // tabla seguimiento de documentos
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->comment('{usuario_id} id del usuario');
            $table->foreignId('vehicle_id')->nullable()->constrained('vehicles')->comment('{vehiculo_id} id del vehículo');
            $table->foreignId('resourceDocument_id')->nullable()->constrained('resource_documents')->comment('{documento_recurso_id} id del documento de recurso');
            $table->string('name_document')->nullable()->comment('{nombre_documento} nombre del documento de recurso');
            $table->date('start_date')->nullable()->comment('{fecha_inicio} fecha de inicio del seguimiento del documento');
            $table->date('end_date')->nullable()->comment('{fecha_final} fecha de finalización del seguimiento del documento');
            $table->enum('traffic_light', ['1', '2', '3'])->nullable()->comment('{semaforo} estado del semáforo del seguimiento del documento (red, orange, green)');
            $table->foreignId('period')->constrained('periods')->comment('{periodo} id del periodo de vencimiento del seguimiento del documento');
            $table->enum('priority', ['1', '0'])->default('0')->comment('{prioridad} prioridad de validación del seguimiento del documento (Alta 1=si, 0=no Baja)');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_trackings');
    }
};
