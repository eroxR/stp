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
        Schema::create('cities', function (Blueprint $table) {//ciudades
            $table->id();
            $table->string('city_name')->comment('{nombre_ciudad} nombre de ciudad');
            $table->foreignId('partner_country')->constrained('countries')->comment('{pais_id} pais asociado a la ciudad');
            $table->foreignId('associate_department')->constrained('provinces')->comment('{departamento_id} departamento asociado a la ciudad');

            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
