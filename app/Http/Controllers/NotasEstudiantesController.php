<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActualizarNotasEstudiantes;
use App\Http\Requests\CrearNotasEstudiantes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NotasEstudiantes;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;


class NotasEstudiantesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {

        try {
            // Obtener todos los comentarios
               $notasEstudiantes =NotasEstudiantes::all();
            
              // Devolver la respuesta JSON con los comentarios
               return response()->json([
                   'notas' => $notasEstudiantes]);
           } catch (Exception $e) {
               // En caso de error, devolver una respuesta JSON con un mensaje de error
               return response()->json([
                   'message' => 'Error al obtener las notas: ' . $e->getMessage()
               ], 500); // Código de estado HTTP 500 para indicar un error del servidor
           } 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show($id): JsonResponse
    {
        try {
            
            $notasEstudiantes = NotasEstudiantes::findOrFail($id);
 
                        return response()->json([
                'notas' => $notasEstudiantes
            ]);
        } catch (ModelNotFoundException $e) {
            
            return response()->json(['message' => 'la nota no existe'], 404);
        } catch (Exception $e) {
            
            return response()->json([
                'message' => 'Error al obtener nota: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CrearNotasEstudiantes $request): JsonResponse  
    {
        try {
            $data = $request->validated();
          
            $notasEstudiantes =  NotasEstudiantes::create([
                'id_evaluacion'=> $data['id_evaluacion'],
                'id_estudiante'=> $data['id_estudiante'],
                'nota'=> $data['nota'],
            
            ]);
 
            return response()->json([
                'message' => 'Nota registrada correctamente',
                'token' => $notasEstudiantes->createToken("token")->plainTextToken,
                'comentario' => $notasEstudiantes
            ], 201); // Código de estado HTTP 201 para indicar éxito en la creación
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            // En caso de error, devolver una respuesta JSON con un mensaje de error
            return response()->json([
                'message' => 'Error al registrar la Nota: ' . $e->getMessage(),
                'errors' => $errors
            ], 422); // Código de estado HTTP 422 para indicar una solicitud mal formada debido a errores de validación
        } catch (Exception $e) {
            // En caso de otros errores, devuelve un mensaje genérico de error
            return response()->json([
                'message' => 'Error al registrar la nota: ' . $e->getMessage()
            ], 500); // Código de estado HTTP 500 para indicar un error del servidor
        } 
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(ActualizarNotasEstudiantes $request, $id): JsonResponse
    {
        try {
            
            $notasEstudiantes = NotasEstudiantes::findOrFail($id);
 
            $data = $request->validated();
 
            
            $notasEstudiantes->update([
                'id_evaluacion'=> $data['id_evaluacion'],
                'id_estudiante'=> $data['id_estudiante'],
                'nota'=> $data['nota'],
        
            ]);
 
            return response()->json([
                'message' => 'nota registrado correctamente',
                'token' => $notasEstudiantes->createToken("token")->plainTextToken,
                'notas' => $notasEstudiantes
            ], 201); // Código de estado HTTP 201 para indicar éxito en la creación

           
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'la nota no existe'], 404);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            // En caso de error, devolver una respuesta JSON con un mensaje de error
            return response()->json([
                'message' => 'Error al actualizar la nota: ' . $e->getMessage(),
                'errors' => $errors
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Encuentra el usuario por su ID
            $notasEstudiantes = NotasEstudiantes::findOrFail($id);
            // Verificar si el usuario existe
            if (!$notasEstudiantes) {
                return response()->json([
                    'message' => 'la nota no existe'
                ], 404); // Código de estado HTTP 404 para indicar que el recurso no se encontró
            }
 
            // Si el usuario existe, intentar eliminarlo
            $notasEstudiantes->delete();
 
            return response()->json([
                'message' => 'nota eliminada correctamente',
            ]);
        } catch (Exception $e) {
            // En caso de error, devolver una respuesta JSON con un mensaje de error
            return response()->json([
                'message' => 'Error al eliminar la nota: ' . $e->getMessage()
            ], 500); // Código de estado HTTP 500 para indicar un error del servidor
        }
    }
}
