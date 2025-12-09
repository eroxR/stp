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
        Schema::create('arls', function (Blueprint $table) { //tabla arls
            $table->id();
            $table->string('description_arl', 120)->comment('{descripcion_arl} descripcion nombre de la arl');
            $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible de la arl ante el uso de los usuarios (visible/invisible)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arls');
    }
};
