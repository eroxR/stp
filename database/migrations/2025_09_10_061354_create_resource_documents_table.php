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
        Schema::create('resource_documents', function (Blueprint $table) {//tabla documentos de recursos
            $table->id();
            $table->foreignId('user_id')->constrained('users')->comment('{id_usuario} id del usuario');
            $table->date('medical_exams')->nullable()->comment('{fecha_examen_medico} fecha del examen médico ocupacional');
            $table->enum('priority_medical_exams', ['1', '0'])->default('0')->comment('{prioridad_examen_medico} prioridad de validación del examen médico (Alta 1=si, 0=no Baja)');
            $table->foreignId('period_medical_exams')->constrained('periods')->comment('{periodo_examen_medico} id del periodo de vencimiento del examen médico');
            $table->date('induction_reinduction')->nullable()->comment('{fecha_induccion_reinduccion} fecha del curso de inducción o reinducción');
            $table->enum('priority_induction_reinduction', ['1', '0'])->default('0')->comment('{prioridad_induccion_reinduccion} prioridad de validación del curso (Alta 1=si, 0=no Baja)');
            $table->foreignId('period_induction_reinduction')->constrained('periods')->comment('{periodo_induccion_reinduccion} id del periodo de vencimiento del curso');
            $table->date('attorney_record')->nullable()->comment('{fecha_poder_procuraduria} fecha del certificado de procuraduría');
            $table->enum('priority_attorney_record', ['1', '0'])->default('0')->comment('{prioridad_procuraduria} prioridad de validación del certificado de procuraduría (Alta 1=si, 0=no Baja)');
            $table->foreignId('period_attorney_record')->constrained('periods')->comment('{periodo_procuraduria} id del periodo de vencimiento del certificado');
            $table->date('comptroller_record')->nullable()->comment('{fecha_certificado_contraloria} fecha del certificado de la contraloría');
            $table->enum('priority_comptroller_record', ['1', '0'])->default('0')->comment('{prioridad_certificado_contraloria} prioridad de validación del certificado (Alta 1=si, 0=no Baja)');
            $table->foreignId('period_comptroller_record')->constrained('periods')->comment('{periodo_certificado_contraloria} id del periodo de vencimiento del certificado');
            $table->date('police_record')->nullable()->comment('{fecha_certificado_record_policial} fecha del certificado del record policial');
            $table->enum('priority_police_record', ['1', '0'])->default('0')->comment('{prioridad_certificado_record_policial} prioridad de validación del certificado (Alta 1=si, 0=no Baja)');
            $table->foreignId('period_police_record')->constrained('periods')->comment('{periodo_certificado_record_policial} id del periodo de vencimiento del certificado');
            $table->integer('labor_reference')->nullable()->comment('{referencia_laboral} id del documento de referencia laboral');
            $table->integer('resume_format')->nullable()->comment('{formato_hoja_devida} id del documento del formato hoja de vida');
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
        Schema::dropIfExists('resource_documents');
    }
};
