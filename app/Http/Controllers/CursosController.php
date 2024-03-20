<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrearCurso;
use App\Http\Requests\ActualizarCurso;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cursos;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
class CursosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Obtener todos los usuarios
            $cursos = Cursos::all();
            // Devolver la respuesta JSON con los usuarios
            return response()->json([
                'cursos' => $cursos
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'el curso no existe'], 404);
        } catch (Exception $e) {
            return response()->json([
              'message' => 'Error al obtener el curso: '. $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show($id): JsonResponse
    {
        try {
            
            $cursos = Cursos::findOrFail($id);
 
                        return response()->json([
                'cursos' => $cursos
            ]);
        } catch (ModelNotFoundException $e) {
            
            return response()->json(['message' => 'el curos no existe'], 404);
        } catch (Exception $e) {
            
            return response()->json([
                'message' => 'Error al obtener curso: ' . $e->getMessage()
            ], 500);
        }       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CrearCurso $request): JsonResponse 
    {
        try {
            $data = $request->validated();
          
            $cursos =  Cursos::create([
               
                
                'id_docente'=> $data['id_docente'],
                'id_categoria'=> $data['id_categoria'],
                'titulo'=> $data['titulo'],
                'descripcion'=> $data['descripcion'],
                'imagen_path'=> $data['imagen_path'],
                'duracion'=> $data['duracion'],
                'estado'=> $data['estado'],
                'fecha_inicio'=> $data['fecha_inicio'],
                'fecha_fin'=> $data['fecha_fin'],


            ]);
 
            return response()->json([
                'message' => 'Nota registrada correctamente',
                'token' => $cursos->createToken("token")->plainTextToken,
                'curso' => $cursos
            ], 201); // Código de estado HTTP 201 para indicar éxito en la creación
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            // En caso de error, devolver una respuesta JSON con un mensaje de error
            return response()->json([
                'message' => 'Error al registrar el curso: ' . $e->getMessage(),
                'errors' => $errors
            ], 422); // Código de estado HTTP 422 para indicar una solicitud mal formada debido a errores de validación
        } catch (Exception $e) {
            // En caso de otros errores, devuelve un mensaje genérico de error
            return response()->json([
                'message' => 'Error al registrar el curso: ' . $e->getMessage()
            ], 500); // Código de estado HTTP 500 para indicar un error del servidor
        } 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
