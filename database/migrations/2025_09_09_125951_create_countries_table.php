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
        Schema::create('countries', function (Blueprint $table) { //paises
            $table->id();
            $table->string('code_country', 3)->unique()->comment('{codigo_pais} id o codigo unico del pais');
            $table->string('country_name', 60)->comment('{nombre_pais} nombre del pais');
            // $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible del pais ante el uso de las compañias (visible/invisible)');
            $table->json('company_view')->nullable()->comment('{visibilidad_empresa} array de empresas a las cuales el pais no es visible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
