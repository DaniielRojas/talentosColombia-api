<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ActualizarUsuarioRequest extends FormRequest
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
        $usuario_id = $this->route("usuario");

        return [
            'nombre' => 'string|max:255',
            'apellido' => 'string|max:255',
            'numero_documento' => ["required",   Rule::unique('usuarios')->ignore($usuario_id)] , // Asegura que el número de documento sea único en la tabla 'usuarios'
            'nombre_usuario' => ["required", Rule::unique('usuarios')->ignore($usuario_id)] ,  // Asegura que el nombre de usuario sea único en la tabla 'usuarios'
            'correo' => ["required", "email", Rule::unique('usuarios')->ignore($usuario_id)] ,
            // Asegura que el correo sea único en la tabla 'usuarios' y tenga formato de correo electrónico
            'imagen' => 'nullable|string', // Asegura que la imagen sea un archivo de imagen válido y tenga un tamaño máximo de 2MB
            'rol_id' => 'required', // Asegura que el 'rol_id' exista en la tabla 'roles'
            'documento_id' => 'required', // Asegura que el 'documento_id' exista en la tabla 'documentos'
            'fecha_nacimiento' => 'string|max:255',
            'direccion' => 'string|max:255'

        ];
    }
}
