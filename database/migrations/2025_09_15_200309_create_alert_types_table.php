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
        Schema::create('alert_types', function (Blueprint $table) {// tabla tipos de alertas
            $table->id();
            $table->string('name', 100)->comment('{nombre} nombre del tipo de alerta');
            $table->text('description')->nullable()->comment('{descripcion} descripcion del tipo de alerta');
            $table->enum('everity_level', ['1', '2', '3'])->nullable()->comment('{nivel_severidad} nivel de severidad de la alerta ( "info", "warning", "danger")');
            $table->string('icon', 100)->nullable()->comment('{icono} icono del tipo de alerta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alert_types');
    }
};
