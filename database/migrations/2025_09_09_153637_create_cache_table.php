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
        Schema::create('cache', function (Blueprint $table) {//chache
            $table->string('key')->primary()->comment('{clave} clave de la caché');
            $table->mediumText('value')->comment('{valor} valor de la caché');
            $table->integer('expiration')->comment('{expiracion} tiempo de expiración de la caché');
        });

        Schema::create('cache_locks', function (Blueprint $table) {//cache_locks
            $table->string('key')->primary()->comment('{clave} clave del candado');
            $table->string('owner')->comment('{dueño} dueño del candado');
            $table->integer('expiration')->comment('{expiracion} tiempo de expiración del candado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};
