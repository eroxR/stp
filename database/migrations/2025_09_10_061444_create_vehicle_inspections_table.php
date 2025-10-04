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
        Schema::create('vehicle_inspections', function (Blueprint $table) {//tabla de inspecciones de vehiculos
            $table->id();

            $table->foreignId('id_vehicle')->constrained('vehicles')->comment('{id_vehicle} id del vehiculo de la inspección');
	        $table->date('dates_start')->nullable()->comment('{fecha_inicio} fecha de inicio cuando se inicia la inspección');
	        $table->date('dates_end')->nullable()->comment('{fecha_fin} fecha de fin cuando se termina la inspección');
	        $table->boolean('uninspected')->default(false)->comment('{sin_inspeccionar} array que indica si la inspección no se realizó en ciertos días');
	        $table->string('responsible')->nullable()->comment('{responsable} nombre del responsable de la inspección, al elegir la placa se debe de arrastrar el nombre del conductor asignado al vehículo');
	        $table->integer('mileage_start')->nullable()->comment('{kilometraje_inicial} kilometraje del primer dia de la inspección');
	        $table->integer('mileage_end')->nullable()->comment('{kilometraje_final} kilometraje del ultimo dia de la inspección');
	        $table->json('array_inspection')->nullable()->comment('{arreglo_inspeccion} arreglo con los dias donde si se realizo la inspección');
            // $table->text('observation')->nullable()->comment('{observaciones} observaciones adicionales');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_inspections');
    }
};
