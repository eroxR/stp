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
        Schema::create('charges', function (Blueprint $table) {//tabla cargos
            $table->id();
            $table->foreignId('area')->nullable()->constrained('work_areas')->comment('{area_id} Area de trabajo asociada al cargo');
            $table->string('code_charge', 5)->unique()->comment('{codigo_cargo} codigo del cargo');
            $table->string('description_charge', 120)->comment('{descripcion_cargo} descripcion del cargo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charges');
    }
};
