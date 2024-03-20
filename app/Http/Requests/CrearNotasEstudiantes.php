<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearNotasEstudiantes extends FormRequest
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
            'id_estudiante' => 'required|integer',
            'nota' => 'required|numeric|min:0|max:100',
        ];
    }
}
