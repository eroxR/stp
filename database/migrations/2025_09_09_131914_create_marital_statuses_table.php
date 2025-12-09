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
        Schema::create('marital_statuses', function (Blueprint $table) { //tabla estado civil
            $table->id();
            $table->string('description_maritalstatus', 120)->comment('{descripcion_estado_civil} descripcion del estado Civil');
            $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible del estado civil ante el uso de los usuarios (visible/invisible)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marital_statuses');
    }
};
