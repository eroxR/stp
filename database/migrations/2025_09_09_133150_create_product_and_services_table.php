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
        Schema::create('product_and_services', function (Blueprint $table) {//tabla de productos y servicios
            $table->id();
            $table->string('ProductandService_description', 120)->comment('{descripcion_productoyservicio} descripción del tipo de producto y servicio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_and_services');
    }
};
