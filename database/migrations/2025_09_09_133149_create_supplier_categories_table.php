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
        Schema::create('supplier_categories', function (Blueprint $table) { //tabla categoria proveedor
            $table->id();
            $table->string('description_categorysupplier', 120)->comment('{descripcion_categoria_proveedor} descripcion de la Categoria Proveedor');
            $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible de la Categoria Proveedor ante el uso de los usuarios (visible/invisible)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_categories');
    }
};
