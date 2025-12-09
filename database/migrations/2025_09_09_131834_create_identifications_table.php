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
        Schema::create('identifications', function (Blueprint $table) { //documento de identificacion
            $table->id();
            $table->string('description_identification', 120)->comment('{descripcion_identificacion} descripción de documento de identificacion');
            $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible del documento de identificación ante el uso de los usuarios (visible/invisible)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identifications');
    }
};
