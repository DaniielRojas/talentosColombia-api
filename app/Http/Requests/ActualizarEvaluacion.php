<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActualizarEvaluacion extends FormRequest
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
            'id_docente' => 'required',
            'id_curso' => 'required',
            'tipo' => 'required|string|max:255',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'nota_maxima' => 'required|string|max:255',
            'fecha_inicio' => 'required|string',
            'fecha_fin' => 'required|string',
            'estado' => 'nullable|string',
        ];
    }
}
