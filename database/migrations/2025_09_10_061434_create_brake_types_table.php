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
        Schema::create('brake_types', function (Blueprint $table) {//tipos de frenos que usa el vehiculo
            $table->id();
            $table->string('brake_type_description', 120)->comment('{descripcion_tipo_freno} descripción del tipos de frenos que usa el vehiculo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brake_types');
    }
};
