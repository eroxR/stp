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
        Schema::create('relationships', function (Blueprint $table) { //Parentezco
            $table->id();
            $table->string('description_relationship', 45)->comment('{descripcion_parentezco} descripcion nombre del Parentezco');
            $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible del parentezco ante el uso de los usuarios (visible/invisible)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relationships');
    }
};
