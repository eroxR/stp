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
        Schema::create('jobs', function (Blueprint $table) {//tabla de trabajos en cola
            $table->id();
            $table->string('queue')->index()->comment('{cola} nombre de la cola');
            $table->longText('payload')->comment('{carga_util} datos de la tarea');
            $table->unsignedTinyInteger('attempts')->comment('{intentos} numero de intentos');
            $table->unsignedInteger('reserved_at')->nullable()->comment('{reservado_en} fecha de reserva');
            $table->unsignedInteger('available_at')->comment('{disponible_en} fecha de disponibilidad');
            $table->unsignedInteger('created_at')->comment('{creado_en} fecha de creación');
        });

        Schema::create('job_batches', function (Blueprint $table) {//tabla de lotes de trabajos
            $table->string('id')->primary();
            $table->string('name')->comment('{nombre} nombre del lote');
            $table->integer('total_jobs')->comment('{total_trabajos} total de trabajos en el lote');
            $table->integer('pending_jobs')->comment('{trabajos_pendientes} trabajos pendientes');
            $table->integer('failed_jobs')->comment('{trabajos_fallidos} trabajos fallidos');
            $table->longText('failed_job_ids')->comment('{ids_trabajos_fallidos} ids de trabajos fallidos');
            $table->mediumText('options')->nullable()->comment('{opciones} opciones del lote');
            $table->integer('cancelled_at')->nullable()->comment('{cancelado_en} fecha de cancelación');
            $table->integer('created_at')->comment('{creado_en} fecha de creación');
            $table->integer('finished_at')->nullable()->comment('{finalizado_en} fecha de finalización');
        });

        Schema::create('failed_jobs', function (Blueprint $table) { //tabla de trabajos fallidos
            $table->id();
            $table->string('uuid')->unique()->comment('{uuid} identificador único universal');
            $table->string('connection')->comment('{conexión} nombre de la conexión');
            $table->string('queue')->comment('{cola} nombre de la cola');
            $table->longText('payload')->comment('{carga_util} datos de la tarea');
            $table->longText('exception')->comment('{excepción} mensaje de error');
            $table->timestamp('failed_at')->useCurrent()->comment('{fallido_en} fecha de fallo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('failed_jobs');
    }
};
