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
        Schema::create('vehicles', function (Blueprint $table) {//tabla vehículos
            $table->id();
            $table->string('plate_vehicle', 12)->unique()->comment('{placa_vehiculo} numero unico de placa del vehículo');
            $table->foreignId('brand_vehicle')->nullable()->constrained('vehicle_brands')->comment('{marca_vehiculo} codigo de la marca comercial del vehículo');
            $table->foreignId('vehicle_line')->nullable()->constrained('vehicle_lines')->comment('{linea_vehiculo} codigo de la linea del vehículo');
            $table->date('registration_date')->nullable()->comment('{fecha_matricula} fecha en que se matriculó el vehículo');
            $table->year('model_vehicle')->nullable()->comment('{modelo_vehiculo} año o modelo de espedición del vehículo');
            $table->string('vehicle_chassis_number', 120)->nullable()->comment('{numero_chasis_vehículo} numero unico del chasis(VIN) del vehículo');
            $table->string('engine_number')->nullable()->comment('{numero_motor} Número del motor del vehículo');
            $table->string('property_card_number')->nullable()->comment('{numero_tarjeta_propiedad} tarjeta de propiedad del vehículo');
            $table->string('cylinder_vehicle', 7)->nullable()->comment('{ciliontraje_vehiculo} cilindraje cubicos del vehículo');
            $table->foreignId('vehicle_type')->nullable()->constrained('vehicle_types')->comment('{tipo_vehiculo} codigo del tipo o clase del vehículo');
            $table->string('side_vehicle', 4)->nullable()->comment('{lateral_vehiculo} numero unico o Número Interno asignado para el vehículo');
            $table->foreignId('owner_vehicle')->nullable()->constrained('users')->comment('{propietario_vehiculo} codigo del usuario propietario del vehículo');
            $table->foreignId('driver_id')->nullable()->constrained('users')->comment('{conductor_id} codigo del usuario conductor del vehículo');
            $table->integer('number_passenger')->nullable()->comment('{numero_pasajeros} cantidad o nunero de pasajeros maximos que puede llevar el vehículo');
            $table->date('secure_end_date')->nullable()->comment('{fecha_final_seguro} fecha de finalización de la vigencia SOAT(Seguro Obligatorio de Accidentes de Tránsito)');
            $table->enum('priority_secure_end_date', ['1', '0'])->default('0')->comment('{prioridad_fecha_final_seguro} prioridad de validación del SOAT(Seguro Obligatorio de Accidentes de Tránsito) (Alta 1=si, 0=no Baja)');
            $table->foreignId('period_secure_end_date')->constrained('periods')->comment('{periodod_fecha_final_seguro} id del periodo de vencimiento del SOAT(Seguro Obligatorio de Accidentes de Tránsito)');
            $table->date('technomechanical_end_date')->nullable()->comment('{fecha_final_tecnomecanica} fecha de finalización de la vigencia de la revisión tecnomecánica');
            $table->enum('priority_technomechanical_end_date', ['1', '0'])->default('0')->comment('{prioridad_fecha_final_tecnomecanica} prioridad de validación de la revisión tecnomecánica (Alta 1=si, 0=no Baja)');
            $table->foreignId('period_technomechanical_end_date')->constrained('periods')->comment('{periodo_fecha_final_tecnomecanica} id del periodo de vencimiento de la revisión tecnomecánica');
            $table->date('certificate_extracontractual')->nullable()->comment('{certificado_extracontractual} Fecha de vencimiento del certificado de seguro extracontractual');
            $table->enum('priority_certificate_extracontractual', ['1', '0'])->default('0')->comment('{prioridad_certificado_extracontractual} prioridad de validación del certificado de seguro extracontractual (Alta 1=si, 0=no Baja)');
            $table->foreignId('period_certificate_extracontractual')->constrained('periods')->comment('{periodo_certificado_extracontractual} id del periodo de vencimiento del certificado de seguro extracontractual');
            $table->date('civil_contractual')->nullable()->comment('{civil_contractual} Fecha de vencimiento del certificado de seguro civil contractual');
            $table->enum('priority_civil_contractual', ['1', '0'])->default('0')->comment('{prioridad_civil_contractual} prioridad de validación del certificado de seguro civil contractual (Alta 1=si, 0=no Baja)');
            $table->foreignId('period_civil_contractual')->constrained('periods')->comment('{periodo_civil_contractual} id del periodo de vencimiento del certificado de seguro civil contractual');
            $table->enum('internal_external_owner_type', ['1', '2'])->nullable()->comment('{tipo_propietario_externo_interno} tipo o clase de propietario que labora o no labora en la empresa["EXTERNO","INTERNO"]');
            $table->foreignId('infrastructure_vehicle')->nullable()->constrained('vehicle_classes')->comment('{infraestructura_vehiculo} infraestructura o clase de combustible que usa el vehículo');
            $table->enum('vehicle_authorization', ['0', '1', '2'])->DEFAULT('2')->comment('{habilitacion_vehiculo} estado o Habilitación del vehículo["Inhabilitado","Habilitado","Pendiente"]');
            $table->enum('status_vehicle', ['0', '1'])->DEFAULT('1')->comment('{estado_vehiculo} estado del vahiculo["Activo","Inactivo"]');
            $table->string('card_operation', 120)->nullable()->comment('{tarjeta_operacion} numero de tarjeta de operacion del vehículo');
            $table->date('expiration_card_operation')->nullable()->comment('{vencimiento_tarjeta_operacion} fecha de finalización de la vigencia de la tarjeta de operación');
            $table->enum('priority_expiration_card_operation', ['1', '0'])->default('0')->comment('{prioridad_vencimiento_tarjeta_operacion} prioridad de validación de la tarjeta de operación (Alta 1=si, 0=no Baja)');
            $table->foreignId('period_expiration_card_operation')->constrained('periods')->comment('{periodo_vencimiento_tarjeta_operacion} id del periodo de vencimiento de la tarjeta de operación');
            $table->date('expiration_preventive')->nullable()->comment('{vencimiento_preventiva} fecha de finalización de la vigencia del plan de mantenimiento preventivo');
            $table->enum('priority_expiration_preventive', ['1', '0'])->default('0')->comment('{prioridad_vencimiento_preventiva} prioridad de validación del plan de mantenimiento preventivo (Alta 1=si, 0=no Baja)');
            $table->foreignId('period_expiration_preventive')->constrained('periods')->comment('{periodo_vencimiento_preventiva} id del periodo de vencimiento del plan de mantenimiento preventivo');
            $table->date('admission_date')->nullable()->comment('{fecha_ingreso} fecha del primer registro del vehículo');
            $table->date('vehicle_pickup_date')->nullable()->comment('{fecha_retiro_vahiculo} fecha de retiro del vehículo');
            $table->date('vehicle_refund')->nullable()->comment('{reintrego_vehiculo} fecha de reintegro del vehículo');
            $table->string('service', 60)->nullable()->comment('{servicio} tipo de uso o servicio del vehículo');
            $table->enum('color_vehicle', ['Rojo', 'Verde', 'Azul', 'Negro', 'Blanco'])->nullable()->comment('{color_vehiculo} color base del vehículo');
            $table->enum('type_direction', ['1', '2', '3'])->nullable()->comment('{tipo_direccion} tipo de la dirección del vehículo["mecánica","hidráulica","eléctrica"]');
            $table->enum('front_suspension', ['1', '2', '3'])->nullable()->comment('{suspensiones_delantera} tipo de suspención delantera del vehículo ["Suspensión McPherson","Suspensión de doble horquilla","Suspensión de eje rígido"]');
            $table->enum('rear_suspension', ['1', '2', '3'])->nullable()->comment('{suspensiones_trasera} tipo de suspención trasera del vehículo ["Suspensión McPherson","Suspensión de doble horquilla","Suspensión de eje rígido"]');
            $table->foreignId('dimension_rims')->nullable()->constrained('dimension_rims')->comment('{dimension_rines} código de la dimensión de las llantas y del rin que usa el vehículo');
            $table->foreignId('rear_brake_type')->nullable()->constrained('brake_types')->comment('{tipo_freno_trasero} tipo de freno trasero que usa el vehículo');
            $table->foreignId('front_brake_type')->nullable()->constrained('brake_types')->comment('{tipo_freno_delantero} tipo de freno delantero que usa el vehículo');
            $table->foreignId('binding_contract')->nullable()->constrained('contracts')->comment('{contrato_vinculacion} código del contrato de vinculación del vehículo');
            $table->date('last_oil_change')->nullable()->comment('{fecha_ultimo_cambio_aceite} fecha del último cambio de aceite del vehículo');
            $table->enum('priority_last_oil_change', ['1', '0'])->default('0')->comment('{prioridad_ultimo_cambio_aceite} prioridad de validación del último cambio de aceite (Alta 1=si, 0=no Baja)');
            $table->foreignId('period_last_oil_change')->constrained('periods')->comment('{periodo_ultimo_cambio_aceite} id del periodo de vencimiento del último cambio de aceite');
            $table->integer('mileage_last_oil_change')->nullable()->comment('{kilometraje_ultimo_cambio_aceite} kilometraje del último cambio de aceite del vehículo');
            $table->date('next_preventive_maintenance')->nullable()->comment('{proximo_mantenimiento_preventivo} fecha del próximo mantenimiento preventivo del vehículo');
            $table->enum('priority_next_preventive_maintenance', ['1', '0'])->default('0')->comment('{prioridad_proximo_mantenimiento_preventivo} prioridad de validación del próximo mantenimiento preventivo (Alta 1=si, 0=no Baja)');
            $table->foreignId('period_next_preventive_maintenance')->constrained('periods')->comment('{periodo_proximo_mantenimiento_preventivo} id del periodo de vencimiento del próximo mantenimiento preventivo');
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
        Schema::dropIfExists('vehicles');
    }
};
