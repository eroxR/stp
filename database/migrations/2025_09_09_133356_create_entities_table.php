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
        Schema::create('entities', function (Blueprint $table) { //tabla de entidades
            $table->id();
            $table->foreignId('identification')->nullable()->constrained('identifications')->comment('{tipo_documento} tipo_documento');
            $table->string('nit')->unique()->nullable()->comment('{nit} NIT de empresa o proveedor aliado');
            $table->string('company_name_provider', 150)->nullable()->comment('{razon_social_proveedor} razon social de empresa o proveedor aliado');
            $table->string('commercial_reason_supplier', 150)->nullable()->comment('{razon_comercial_proveedor} razon comercial de empresa o proveedor aliado');
            $table->string('supplier_web_page')->nullable()->comment('{pagina_web_proveedor} pagina web de empresa o proveedor aliado');
            $table->foreignId('economic_activity')->nullable()->constrained('economic_activities')->comment('{actividad_economica_proveedor} actividad economica de la empresa o proveedor aliado');
            $table->foreignId('products_and_services')->nullable()->constrained('product_and_services')->comment('{productos_y_servicios_proveedor} productos y servicios de la empresa o proveedor aliado');
            $table->text('supplier_description')->nullable()->comment('{descripcion_proveedor} descripcion de la empresa o proveedor aliado');
            $table->string('supplier_email')->nullable()->comment('{email_proveedor} email de la empresa o proveedor aliado');
            $table->bigInteger('supplier_phone')->nullable()->comment('{telefono_proveedor} telefono de la empresa o proveedor aliado');
            $table->bigInteger('supplier_mobile')->nullable()->comment('{celular_proveedor} celular de la empresa o proveedor aliado');
            $table->string('supplier_address')->nullable()->comment('{direccion_proveedor} direccion de la empresa o proveedor aliado');
            $table->jsonb('type_entity')->nullable()->comment('{tipo_entidad} tipo de entidad a la cual pertenece el tercero a registrar (H entidad de salud, A arl, P pensión, C caja de compensación, )');
            $table->foreignId('company_id')->constrained('companies')->comment('{id_compañia} relación con la tabla empresas');
            $table->string('code_company')->comment('{codigo_compañia} relación con la tabla empresas');
            $table->foreignId('branch_id')->constrained('branches')->comment('{id_sucursal} relación con la tabla sucursales');
            // $table->enum('visibility', ['1', '0'])->default('1')->comment('{visibilidad} estado visible de la Entidad ante el uso de las compañias (visible/invisible)');
            $table->json('company_view')->nullable()->comment('{visibilidad_empresa} array de empresas a las cuales la entidad es visible');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entities');
    }
};
