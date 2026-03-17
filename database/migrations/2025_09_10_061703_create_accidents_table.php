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
        Schema::create('accidents', function (Blueprint $table) {//tabla de accidentes
            $table->id();

            $table->string('accident_place', 150)->comment('{lugar_accidente} lugar del accidente');
            $table->datetime('date_accident')->comment('{fecha_accidente} fecha y hora del accidente');
            $table->text('accident_description')->comment('{descripcion_accidente} descripcion del accidente');
            $table->bigInteger('comparing_number')->comment('{num_comparendo} numero del comparendo');
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
        Schema::dropIfExists('accidents');
    }
};
