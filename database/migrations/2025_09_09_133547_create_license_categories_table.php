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
        Schema::create('license_categories', function (Blueprint $table) {//tabla categorias de licencias de conduccion
            $table->id();
            $table->string('code_licenseCategory', 4)->unique()->comment('{codigo_categoria_licencia} codigo de la categoria de la licencia de conduccion');
            $table->string('description_licenseCategory', 120)->comment('{descripcion_categoria_licencia} descripcion nombre de la categoria de la licencia de conduccion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('license_categories');
    }
};
