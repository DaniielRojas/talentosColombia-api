<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Testing\Fluent\Concerns\Has;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = [
        
           'id',
           'nombre',
           'apellido',
           'numero_documento',
           'nombre_usuario',
           'correo',
           'fecha_nacimiento',
           'contrasena',
            'imagen',
            'rol_id',
            'documento_id',
            'direccion',

    ];
}
