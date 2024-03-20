<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearComentarios extends FormRequest
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
            'id_evaluacion' => 'required|integer',
            'id_usuario' => 'required|integer',
            'contenido' => 'required|string',
            'fecha' => 'required|date',
            'estado' => 'string|nullable',
        ];
    }
}
