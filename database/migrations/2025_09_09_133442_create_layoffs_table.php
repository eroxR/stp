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
        Schema::create('layoffs', function (Blueprint $table) {//cesantias
            $table->id();
            $table->string('description_layoffs', 120)->comment('{descripcion_cesantias} descripcion nombre de las cesantias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layoffs');
    }
};
