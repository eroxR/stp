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
        Schema::create('drivers', function (Blueprint $table) { //tabla conductores
            $table->id();
            $table->foreignId('user_id')->constrained('users')->comment('{usuario_id} id del usuario conductor');
            $table->bigInteger('license_number')->nullable()->comment('{numero_licencia} numero licencia de conducción');
            $table->foreignId('license_category')->constrained('license_categories')->comment('{codigo_categoria} codigo de la categoria de la licencia de conducción');
            $table->date('license_expiration')->nullable()->comment('{fecha_expiracion} fecha de expiración de la licencia de conducción');
            $table->enum('priority_license_expiration', ['1', '0'])->default('0')->comment('{prioridad_licencia} prioridad de validación de la licencia (Alta 1=si, 0=no Baja)');
            $table->foreignId('period_license')->constrained('periods')->comment('{id_periodo_licencia} id del periodo de vencimiento de la licencia');
            $table->bigInteger('assigned_vehicle')->nullable()->comment('{vehiculo_asignado} id de la placa del vehículo asignado al conductor');
            $table->date('certificate_drugs_alchoolemia')->nullable()->comment('{fecha_certificado_drogas_alcoholemia} fecha del certificado de drogas y alcoholemia');
            $table->enum('priority_certificate_drugs_alchoolemia', ['1', '0'])->default('0')->comment('{prioridad_certificado_drogas_alcoholemia} prioridad de validación del certificado (Alta 1=si, 0=no Baja)');
            $table->foreignId('period_certificate_drugs_alchoolemia')->constrained('periods')->comment('{periodo_certificado_drogas_alcoholemia} id del periodo de vencimiento del certificado');
            $table->date('simit_queries')->nullable()->comment('{fecha_certificado_SIMIT} fecha del certificado SIMIT');
            $table->enum('priority_simit_queries', ['1', '0'])->default('0')->comment('{prioridad_SIMIT} prioridad de validación del certificado SIMIT (Alta 1=si, 0=no Baja)');
            $table->foreignId('period_simit_queries')->constrained('periods')->comment('{periodo_SIMIT} id del periodo de vencimiento del certificado SIMIT');
            $table->date('rules_transit')->nullable()->comment('{fecha_certificado_Reglas_Transito} fecha del certificado de Normas de Tránsito');
            $table->enum('priority_rules_transit', ['1', '0'])->default('0')->comment('{prioridad_Reglas_Transito} prioridad de validación del certificado (Alta 1=si, 0=no Baja)');
            $table->foreignId('period_rules_transit')->constrained('periods')->comment('{periodo_Reglas_Transito} id del periodo de vencimiento del certificado');
            $table->date('defensive_driving')->nullable()->comment('{fecha_certificado_Defensivo_conductor} fecha del certificado de Manejo Defensivo');
            $table->enum('priority_defensive_driving', ['1', '0'])->default('0')->comment('{prioridad_Defensivo_conductor} prioridad de validación del certificado (Alta 1=si, 0=no Baja)');
            $table->foreignId('period_defensive_driving')->constrained('periods')->comment('{periodo_Defensivo_conductor} id del periodo de vencimiento del certificado');
            $table->date('first_aid')->nullable()->comment('{fecha_certificado_Primeros_Auxilios} fecha del certificado de Primeros Auxilios');
            $table->enum('priority_first_aid', ['1', '0'])->default('0')->comment('{prioridad_Primeros_Auxilios} prioridad de validación del certificado (Alta 1=si, 0=no Baja)');
            $table->foreignId('period_first_aid')->constrained('periods')->comment('{periodo_Primeros_Auxilios} id del periodo de vencimiento del certificado');
            $table->date('psicosensometrico')->nullable()->comment('{fecha_certificado_psicosensometrico} fecha del certificado Psicosensometrico');
            $table->enum('priority_psicosensometrico', ['1', '0'])->default('0')->comment('{prioridad_psicosensometrico} prioridad de validación del certificado Psicosensometrico (Alta 1=si, 0=no Baja)');
            $table->foreignId('period_psicosensometrico')->constrained('periods')->comment('{periodo_psicosensometrico} id del periodo de vencimiento del certificado');
            $table->date('road_safety')->nullable()->comment('{fecha_certificado_Seguridad_Vial} fecha del certificado de Seguridad Vial');
            $table->enum('priority_road_safety', ['1', '0'])->default('0')->comment('{prioridad_Seguridad_Vial} prioridad de validación del certificado (Alta 1=si, 0=no Baja)');
            $table->foreignId('period_road_safety')->constrained('periods')->comment('{periodo_Seguridad_Vial} id del periodo de vencimiento del certificado');
            $table->enum('driver_status', ['1', '2'])->nullable()->comment('{habilitacion_conductor} estado de la habilitación del conductor [1=Inhabilitado, 2=Habilitado]');
            $table->foreignId('linked')->constrained('users')->comment('{idVinculado} id del usuario dueño del vehículo vinculado');
            $table->enum('isLinked', ['1', '0'])->nullable()->comment('{esVinculado} Indicador de si el conductor es dueño del vehículo (1=Si, 0=No)');
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
        Schema::dropIfExists('drivers');
    }
};
