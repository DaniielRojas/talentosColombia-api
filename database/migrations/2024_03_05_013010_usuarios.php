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
            $table->integer('id')->autoIncrement()->nullable(false);
            $table->string('nombre')->nullable(false);
            $table->string('apellido')->nullable(false);
            $table->string('numero_documento')->nullable(false);
            $table->string('nombre_usuario')->nullable(false);
            $table->string('correo')->nullable(false);
            $table->string('direccion')->nullable(false);
            $table->timestamp('fecha_nacimiento')->nullable(false);
            $table->string('contrasena')->nullable(false);
            $table->string('imagen')->nullable(false);
            $table->integer('rol_id')->nullable(false);
            $table->integer('documento_id')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
            
         
    });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
