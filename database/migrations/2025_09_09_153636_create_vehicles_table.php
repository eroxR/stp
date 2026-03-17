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
        Schema::create('vehicles', function (Blueprint $table) { //tabla vehículos
            $table->id();
            $table->string('plate_vehicle', 12)->unique()->comment('{placa_vehiculo} numero unico de placa del vehículo');
            $table->foreignId('brand_vehicle')->nullable()->constrained('vehicle_brands')->comment('{marca_vehiculo} codigo de la marca comercial del vehículo');
            $table->foreignId('vehicle_line')->nullable()->constrained('vehicle_lines')->comment('{linea_vehiculo} codigo de la linea del vehículo');
            $table->foreignId('vehicle_class')->nullable()->constrained('vehicle_classes')->comment('{clase_vehiculo} codigo de la clase del vehículo');
            $table->foreignId('fueltype')->nullable()->constrained('fuel_types')->comment('{tipo_combustible} tipo de combustible del vehículo');
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
            $table->enum('internal_external_owner_type', ['1', '2'])->nullable()->comment('{tipo_propietario_externo_interno} tipo o clase de propietario que labora o no labora en la empresa(1=EXTERNO,2=INTERNO)');
            $table->foreignId('infrastructure_vehicle')->nullable()->constrained('vehicle_classes')->comment('{infraestructura_vehiculo} infraestructura o clase de combustible que usa el vehículo');
            $table->enum('vehicle_authorization', ['1', '2', '3'])->DEFAULT('1')->comment('{habilitacion_vehiculo} estado o Habilitación del vehículo (1=Inhabilitado,2=Habilitado,3=Pendiente)');
            $table->enum('status_vehicle', ['1', '2'])->DEFAULT('1')->comment('{estado_vehiculo} estado del vahiculo (1=Activo,2=Inactivo)');
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
