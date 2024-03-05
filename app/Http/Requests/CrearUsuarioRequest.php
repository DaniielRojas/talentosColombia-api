<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearUsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'numero_documento' => 'required|string|max:20|unique:usuarios,numero_documento', // Asegura que el número de documento sea único en la tabla 'usuarios'
            'nombre_usuario' => 'required|string|max:255|unique:usuarios,nombre_usuario', // Asegura que el nombre de usuario sea único en la tabla 'usuarios'
            'correo' => 'required|string|email|max:255|unique:usuarios,correo', // Asegura que el correo sea único en la tabla 'usuarios' y tenga formato de correo electrónico
            'contrasena' => 'required|string|min:8', // Asegura que la contraseña tenga al menos 8 caracteres
            'imagen' => 'nullable|string', // Asegura que la imagen sea un archivo de imagen válido y tenga un tamaño máximo de 2MB
            'rol_id' => 'required', // Asegura que el 'rol_id' exista en la tabla 'roles'
            'documento_id' => 'required', // Asegura que el 'documento_id' exista en la tabla 'documentos'
            'fecha_nacimiento' => 'required|string|max:255',
            'direccion' => 'required|string|max:255'


        ];
    }
}
