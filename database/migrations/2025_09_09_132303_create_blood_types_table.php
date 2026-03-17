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
        Schema::create('blood_types', function (Blueprint $table) { //tipos de sangre
            $table->id();
            $table->string('blood_type_description', 25)->comment('descripcion_tipo_sangre} descripcion tipo Sangre');
            // $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible del tipo de sangre ante el uso de las compañias (visible/invisible)');
            $table->json('company_view')->nullable()->comment('{visibilidad_empresa} array de empresas a las cuales el tipo de sangre no es visible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_types');
    }
};
