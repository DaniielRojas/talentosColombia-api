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
        Schema::create ('comentarios', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->nullable(false);
            $table->integer('id_evaluacion')->nullable(false);
            $table->integer('id_usuario')->nullable(false);
            $table->string('contenido')->nullable(false);
            $table->timestamp('fecha')->nullable(false);
            $table->string('estado');
            $table->timestamps();
    
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
