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
        Schema::create('periods', function (Blueprint $table) {//tabla periodos de vencimiento
            $table->id();
            $table->string('name_period')->unique()->comment('{nombre_periodo} nombre del periodo de vencimiento');
            $table->integer('days_period')->comment('{dias_periodo} número de días del periodo de vencimiento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periods');
    }
};
