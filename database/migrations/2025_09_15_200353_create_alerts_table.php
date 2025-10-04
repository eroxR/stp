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
        Schema::create('alerts', function (Blueprint $table) { // tabla de alertas
            $table->id();
            $table->foreignId('alertStatus_id')->constrained('alert_statuses')->comment('{estado_alerta} estado de la alerta');
            $table->foreignId('alertType_id')->constrained('alert_types')->comment('{tipo_alerta} tipo de alerta');
            $table->string('title_alert', 100)->comment('{titulo_alerta} titulo de la alerta');
            $table->json('description_alert')->comment('{descripcion_alerta} descripcion de la alerta');
            $table->timestamp('alert_registration_date')->comment('{fecha_registro_alerta} fecha de registro de la alerta');
            $table->timestamp('alert_attention_date')->comment('{fecha_atención_alerta} fecha de atención de la alerta');
            $table->integer('alertable_id')->comment('{alertable_id} id de la tabla polimorfica');
            $table->string('alertable_type')->comment('{alertable_type} nombre de la tabla polimorfica');
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
        Schema::dropIfExists('alerts');
    }
};
