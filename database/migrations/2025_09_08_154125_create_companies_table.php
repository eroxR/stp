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
        Schema::create('companies', function (Blueprint $table) { //empresas
            $table->id();
            $table->string('code_company')->unique()->comment('{codigo_empresa} codigo de la empresa');
            $table->string('name_company')->comment('{nombre_empresa} nombre o razón social de la empresa');
            $table->string('nit_company')->unique()->comment('{nit_empresa} número de identificación tributaria');
            $table->string('acronym_company')->nullable()->comment('{siglas_empresa} siglas de la empresa');
            $table->string('economic_activity_code')->unique()->comment('{codigo_actividad_economica} código de actividad económica');
            $table->string('economic_activity_nombre')->unique()->comment('{nombre_actividad_economica} nombre de la actividad económica');
            $table->string('legal_representative')->nullable()->comment('{representante_legal} nombre del representante legal de la empresa');
            $table->string('legal_representative_identification')->nullable()->comment('{identificacion_representante_legal} identificación del representante legal de la empresa');
            $table->string('legal_representative_document')->nullable()->comment('{documento_identidad_representante_legal} documento de identidad del representante legal de la empresa');
            $table->string('legal_representative_expedition_identificationcard')->nullable()->comment('{fecha_expedicion_documento_representante_legal} fecha de expedición del documento de identidad del representante legal de la empresa');
            $table->string('address_representative_legal')->nullable()->comment('{direccion_representante_legal} dirección del representante legal de la empresa');
            $table->string('phone_representative_legal')->nullable()->comment('{telefono_representante_legal} teléfono del representante legal de la empresa');
            $table->string('email_representative_legal')->nullable()->comment('{email_representante_legal} correo electrónico del representante legal de la empresa');
            $table->string('digital_signature_legal_representative')->nullable()->comment('{firma_digital_representante_legal} firma digital del representante legal');
            $table->string('legal_nature')->nullable()->comment('{naturaleza_juridica} naturaleza jurídica de la empresa(publica, privada, mixta)');
            $table->string('address_company')->nullable()->comment('{direccion_empresa} dirección de la empresa');
            $table->string('phone_company')->nullable()->comment('{telefono_empresa} teléfono de la empresa');
            $table->string('email_company')->nullable()->comment('{correo_electronico_empresa} correo electrónico de la empresa');
            $table->string('website_company')->nullable()->comment('{sitio_web_empresa} sitio web de la empresa');
            $table->string('scope_company')->nullable()->comment('{alcance_empresa} alcance de la empresa');
            $table->text('description_company')->nullable()->comment('{descripcion_empresa} descripción de la empresa');
            $table->string('country_company')->nullable()->comment('{pais_empresa} país de la empresa');
            $table->string('province_company')->nullable()->comment('{departameto_empresa} estado/provincia/departamento de la empresa');
            $table->string('city_company')->nullable()->comment('{ciudad_empresa} ciudad de la empresa');
            $table->text('mission_company')->nullable()->comment('{mision_empresa} misión de la empresa');
            $table->text('vision_company')->nullable()->comment('{vision_empresa} visión de la empresa');
            $table->text('values_company')->nullable()->comment('{valores_empresa} valores de la empresa');
            $table->string('postal_code_company')->nullable()->comment('{codigo_postal_empresa} código postal de la empresa');
            $table->integer('number_employees')->nullable()->comment('{numero_empleados} número de empleados de la empresa');
            $table->integer('number_branches')->nullable()->comment('{numero_sucursales} número de sucursales de la empresa');
            $table->enum('status_company',['1','0'])->default('1')->comment('{estado_empresa} estado de la empresa (activo/inactivo)');
            $table->enum('plans_company',['b','m','p'])->default('b')->comment('{planes_empresa} planes de la empresa (básico, moderado, premium)');
            $table->timestamp('trial_ends_at')->nullable()->comment('{fecha_fin_prueba} fecha de finalización del período de prueba');
            $table->timestamp('subscription_start_at')->nullable()->comment('{fecha_inicio_suscripcion} fecha de inicio de la suscripción');
            $table->timestamp('subscription_ends_at')->nullable()->comment('{fecha_fin_suscripcion} fecha de finalización de la suscripción');
            $table->string('renewal_date')->nullable()->comment('{fecha_renovacion} fecha de renovación de la suscripción');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
