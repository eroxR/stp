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
        Schema::create('orders', function (Blueprint $table) { //tabla ordenes o pedidos
            $table->id();
            $table->string('consecutive_order', 20)->unique()->comment('{consecutivo_orden} numero unico por compañia de la orden o pedido');
            $table->date('order_date')->comment('{fecha_orden} fecha en que se realiza la orden o pedido');
            $table->string('requester_name', 120)->comment('{nombre_solicitante} nombre completo de la persona o entidad que realiza la orden o pedido');
            $table->string('requester_phone')->nullable()->comment('{telefono_solicitante} telefono fijo o celular de la persona o entidad que realiza la orden o pedido');
            $table->string('requester_email', 120)->nullable()->comment('{email_solicitante} email de la persona o entidad que realiza la orden o pedido');
            $table->text('order_reason')->nullable()->comment('{motivo_orden} motivo o razón por la cual se realiza la orden o pedido');
            $table->enum('order_status', ['1', '2', '3'])->default('1')->comment('{estado_orden} estado de la orden o pedido ["REGISTRADA","ASIGNADA","CANCELADO"]');
            $table->foreignId('company_id')->constrained('companies')->comment('{id_compañia} relación con la tabla empresas');
            $table->string('code_company')->comment('{codigo_compañia} relación con la tabla empresas');
            $table->foreignId('branch_id')->constrained('branches')->comment('{id_sucursal} relación con la tabla sucursales');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
