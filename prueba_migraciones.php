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
Schema::create('pvd', function (Blueprint $table) { // tabla permisos, vehiculo, conductor
            $table->id();
            $table->foreignId('permit_id')->constrained('permits')->onDelete('cascade')->comment('{permiso_id} id del permiso');
            $table->string('plate_vehicle')->comment('{placa_vehiculo} placa del vehículo actual');
            $table->string('vehicle_type')->comment('{tipo_vehiculo} tipo del vehículo actual');
            $table->string('brand_vehicle')->comment('{marca_vehiculo} marca del vehículo actual');
            $table->string('model_vehicle')->comment('{modelo_vehiculo} modelo del vehículo actual');
            $table->string('side_vehicle', 4)->comment('{lateral_vehiculo} lado del vehículo actual');
            $table->string('card_operation', 120)->comment('{tarjeta_operacion} tarjeta de operación del vehículo actual');
            $table->date('expiration_card_operation')->comment('{fecha_expiracion_tarjeta_operacion} fecha de expiración de la tarjeta de operación');
            $table->date('secure_end_date')->comment('{fecha_expiracion_seguro} fecha de expiración del seguro');
            $table->date('technomechanical_end_date')->comment('{fecha_expiracion_tecnomecanica} fecha de expiración de la revisión tecnomecánica');
            $table->date('expiration_preventive')->nullable()->comment('{fecha_expiracion_preventiva} fecha de expiración de la revisión preventiva');
            $table->string('driver_names_lastnames')->comment('{nombres_apellidos_conductor} nombres y apellidos del conductor');
            $table->string('document_number')->comment('{numero_documento} número de documento del conductor');
            $table->string('license_number')->comment('{numero_licencia} número de licencia del conductor');
            $table->string('expiration_license')->comment('{fecha_expiracion_licencia} fecha de expiración de la licencia del conductor');
            $table->timestamps();
        });
    }


};