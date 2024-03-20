<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Testing\Fluent\Concerns\Has;
use Laravel\Sanctum\HasApiTokens;

class Cursos extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = [
        'id',
        'id_docente',
        'id_categoria',
        'titulo',
        'descripcion',
        'imagen_path',
        'duracion',
        'estado',
        'fecha_inicio',
        'fecha_fin',
    ];
}
