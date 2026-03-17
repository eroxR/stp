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
        Schema::create('contracts', function (Blueprint $table) { // tabla contratos
            $table->id();

            $table->integer('contract_number')->comment('{numero_contrato} numero unico de contrato agrupados por tipo de contrato');
            $table->foreignId('code_order')->constrained('orders')->comment('{codigo_orden} relación con la tabla órdenes');
            $table->foreignId('type_contract')->constrained('contract_types')->comment('{tipo_contrato} tipo de contrato de acuerdo a la necesidad del cliente o usuario');
            $table->foreignId('origin_route')->constrained('routes')->comment('{origen_ruta} origen de la ruta del contrato');
            $table->foreignId('destination_route')->constrained('routes')->comment('{destino_ruta} destino de la ruta del contrato');
            $table->date('date_start_contract')->comment('{fecha_ini_contrato} fecha de inicio del contrato');
            $table->date('contract_end_date')->nullable()->comment('{fecha_fin_contrato} fecha de finalización del contrato');
            $table->decimal('contract_value', 12, 2)->nullable()->comment('{valor_contrato} valor numerico a pagar para celebrar el contrato');
            $table->string('contracting_name', 120)->comment('{nombre_contratante} nombre completo de la persona contratante');
            $table->enum('status_contract', ['1', '2', '3', '4', '5'])->default('1')->comment('{estado_contrato} [1=ELABORADO, 2=PENDIENTE FIRMA, 3=EN CURSO, 4=FINALIZADO, 5=CANCELADO]');
            $table->foreignId('identification')->nullable()->constrained('identifications')->comment('{identificacion_contratante} codigo del tipo de identificación del contratante');
            $table->string('contract_document')->comment('{documento_identidad_contratante} numero de documento de identidad del contratante');
            $table->string('expedition_identificationcard')->nullable()->comment('{fecha_expedicion_documento_contratante} fecha de expedición del documento del contratante');
            $table->string('contracting_phone')->nullable()->comment('{telefono_contratante} telefono fijo o celular del contratante');
            $table->string('contracting_direction', 150)->nullable()->comment('{direccion_contratante} direccion de residencia del contratante');
            $table->string('contracting_email', 120)->nullable()->comment('{email_contratante} email del contratante');
            $table->string('legal_representative', 120)->nullable()->comment('{representante_legal} representante_legal');
            $table->foreignId('identification_represent_legal')->nullable()->constrained('identifications')->comment('{identificación_represen_legal} tipo de identificación del representante legal');
            $table->string('identificationcard_represent_legal')->nullable()->comment('{cedula_represen_legal} documento de identidad del representante legal');
            $table->string('legal_representative_expedition_identificationcard')->nullable()->comment('{fecha_lugar_expedicion_cedula_representante_legal} fecha y lugar de expedición');
            $table->integer('passenger_quantity')->nullable()->comment('{cantidad_pasajeros} cantidad de pasajeros que iran en el viaje');
            $table->enum('total_disposition', ['1', '2'])->nullable()->comment('{disposicion_Total} disposicion Total del vehículo para el viaje (1=si, 0=no)');
            $table->integer('quantity_vehicle')->nullable()->comment('{cantidad_vehiculos} cantidad de vehiculos que se usaran');
            $table->enum('validate_cooperation_contract', ['1', '2'])->nullable()->comment('{validacion_cooperacion_contrato} valida si hay cooperacion con otra empresa (1=si, 0=no)');
            $table->string('cooperation_contract', 60)->nullable()->comment('{cooperacion_contrato} nombre de la empresa que coopera');
            $table->string('secure_policy', 60)->nullable()->comment('{Poliza_seguros} nombre de la poliza de seguros');
            $table->enum('tipe_pay', ['1', '2', '3', '4', '5', '6', '7'])->nullable()->comment('{tipo_pago} [1=Efectivo,2=Transferencia,3=Consignación,4=Cheque,5=Crédito,6=50/50,7=Otro]');
            $table->date('contract_signing_date')->nullable()->comment('{fecha_firma_contrato} fecha en que se firmó el contrato');
            $table->string('signature_place', 250)->nullable()->comment('{lugar_firma_contrato} lugar donde se firmó el contrato');
            $table->string('school_name', 150)->nullable()->comment('{nombre_colegio} nombre del colegio (si aplica)');
            $table->string('address_school', 150)->nullable()->comment('{direccion_colegio} direccion del colegio (si aplica)');
            $table->string('phone_school', 20)->nullable()->comment('{telefono_colegio} telefono del colegio (si aplica)');
            $table->year('school_year')->nullable()->comment('{año_escolar} año escolar del servicio (si aplica)');
            $table->string('departure_location')->nullable()->comment('{lugar_salida} ubicación del lugar de salida');
            $table->string('place_arrival')->nullable()->comment('{lugar_llegada} ubicación del lugar de llegada');
            $table->string('place_return')->nullable()->comment('{lugar_regreso} ubicación del lugar de regreso');
            $table->timestamp('date_departure_location')->nullable()->comment('{fecha_lugar_salida} fecha y hora de salida');
            $table->timestamp('date_place_arrival')->nullable()->comment('{fecha_lugar_llegada} fecha y hora de llegada');
            $table->timestamp('date_place_return')->nullable()->comment('{fecha_lugar_regreso} fecha y hora de regreso');
            $table->enum('legal_bond', ['1', '2'])->default('1')->nullable()->comment('{vinculo_juridico} vinculo juridico del vehiculo [1=PROPIETARIO, 2=TENEDOR]');
            $table->string('student_name', 120)->nullable()->comment('{nombre_estudiante} nombre completo del estudiante (si aplica)');
            $table->bigInteger('identificationcard_estudent')->nullable()->comment('{documento_etudiante} documento de identidad del estudiante (si aplica)');
            $table->string('grade_student', 20)->nullable()->comment('{grado_estudiante} grado escolar del estudiante (si aplica)');
            $table->string('family_relationship', 120)->nullable()->comment('{parentesco} parentesco con el estudiante (si aplica)');
            $table->string('who_receives', 120)->nullable()->comment('{quien_recibe} nombre de la persona que recibe al estudiante (si aplica)');
            $table->time('start_day')->nullable()->comment('{inicio_jornada} hora de inicio de la jornada del estudiante');
            $table->time('end_day')->nullable()->comment('{finalizacion_jornada} hora de finalización de la jornada del estudiante');
            $table->bigInteger('identificationcard_representative_group')->nullable()->comment('{cedula_representante_grupo} cedula del representante del grupo');
            $table->string('group_representative_name', 60)->nullable()->comment('{nombre_representante_grupo} nombre del representante del grupo');
            $table->string('dateofexpedition_representative_group', 100)->nullable()->comment('{lugar_fecha_expedicion_cedula_representante_grupo} lugar y fecha de expedición del documento');
            $table->string('digital_signature')->nullable()->comment('{firma_digital} ruta de la firma digital del contratante');
            $table->string('digital_signature_representative_group')->nullable()->comment('{firma_digital_representante_grupo} ruta de la firma digital del representante del grupo');
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
        Schema::dropIfExists('contracts');
    }
};
