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
        Schema::create('supplier_categories', function (Blueprint $table) {//tabla categoria proveedor
            $table->id();
            $table->string('description_CategorySupplier', 120)->comment('{descripcion_categoria_proveedor} descripcion de la Categoria Proveedor');
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
