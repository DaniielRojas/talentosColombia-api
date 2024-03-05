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
         
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id')->nullable(false);
            $table->string('nombre')->nullable(false);
            $table->string('apellido')->nullable(true);
            $table->string('numero_documento')->nullable(true);
            $table->string('nombre_usuario')->nullable(true);
            $table->string('correo')->nullable(true);
            $table->string('direccion')->nullable(true);
            $table->timestamp('fecha_nacimiento')->nullable(true);
            $table->string('contrasena')->nullable(true);
            $table->string('imagen')->nullable(true);
            $table->integer('rol_id')->nullable(true);
            $table->integer('documento_id')->nullable(true);
            $table->timestamps();
            $table->softDeletes();
            
         
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
