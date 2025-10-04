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
        Schema::create('alert_statuses', function (Blueprint $table) {// tabla estados de alertas
            $table->id();
            $table->enum('name', ['1', '2', '3', '4'])->comment('{nombre} nombre del estado de la alerta ("Nueva", "En Progreso", "Resuelta", "Archivada"))');
            $table->text('description')->nullable()->comment('{descripcion} descripcion del estado de la alerta');
            $table->string('description_statusalert', 20)->comment('{descripcion_estadoalerta} descripcion del estado de la alerta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alert_statuses');
    }
};
