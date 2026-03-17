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
        Schema::create('product_and_services', function (Blueprint $table) { //tabla de productos y servicios
            $table->id();
            $table->foreignId('supplier_category')->nullable()->constrained('supplier_categories')->comment('{descripcion_categoria_proveedor} descripcion de la Categoria Proveedor');
            $table->string('productandservice_description', 120)->comment('{descripcion_productoyservicio} descripción del tipo de producto y servicio');
            // $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible del producto y servicio ante el uso de las compañias (visible/invisible)');
            $table->json('company_view')->nullable()->comment('{visibilidad_empresa} array de empresas a las cuales los productos y servicios no es visible');
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
