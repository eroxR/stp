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
        Schema::create('provinces', function (Blueprint $table) { //departamentos o provincias
            $table->id();
            $table->string('department_name', 120)->comment('{nombre_departamento} nombre del departamento o provincia');
            $table->foreignId('partner_country')->constrained('countries')->comment('{pais_id} pais asociado de la provincia o departamento');
            $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible de la provincia ante el uso de los usuarios (visible/invisible)');
            $table->timestamps();
            // $table->foreignId('country_id')->constrained(); //{pais_id} pais asociado de la provincia o departamento
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provinces');
    }
};
