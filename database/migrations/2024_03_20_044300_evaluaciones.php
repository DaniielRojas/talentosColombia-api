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
       Schema::create ('evaluaciones', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->nullable(false);
            $table->integer('id_docente')->nullable(false);
            $table->integer('id_curso')->nullable(false);
            $table->string('tipo')->nullable(false);
            $table->string('titulo')->nullable(false);
            $table->string('descripcion')->nullable(false);
            $table->string('nota_maxima')->nullable(false);
            $table->timestamp('fecha_inicio')->nullable(false);
            $table->timestamp('fecha_fin')->nullable(false);
            $table->string('estado');
            $table->timestamps();
    
    });

}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
