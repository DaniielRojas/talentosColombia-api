<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActualizarComentarios;
use App\Http\Requests\CrearComentarios;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comentarios;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
class ComentariosController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
         // Obtener todos los comentarios
            $comentarios =Comentarios::all();
         
           // Devolver la respuesta JSON con los comentarios
            return response()->json([
                'comentarios' => $comentarios
            ]);
        } catch (Exception $e) {
            // En caso de error, devolver una respuesta JSON con un mensaje de error
            return response()->json([
                'message' => 'Error al obtener las comentarios: ' . $e->getMessage()
            ], 500); // Código de estado HTTP 500 para indicar un error del servidor
        } 
    }

    public function show($id)
    {
        try {
            
            $comentarios = Comentarios::findOrFail($id);
 
                        return response()->json([
                'comentarios' => $comentarios
            ]);
        } catch (ModelNotFoundException $e) {
            
            return response()->json(['message' => 'el comentario no existe'], 404);
        } catch (Exception $e) {
            
            return response()->json([
                'message' => 'Error al obtener comentario: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CrearComentarios $request): JsonResponse
    {
        try {
            $data = $request->validated();
          
            $comentarios =  Comentarios::create([
                'id_evaluacion' => $data['id_evaluacion'],
                'id_usuario' => $data['id_usuario'],
                'contenido' => $data['contenido'],
                'fecha' => $data['fecha'],
                'estado' => $data['estado'],      
            ]);
 
            return response()->json([
                'message' => 'Comentario registrada correctamente',
                'token' => $comentarios->createToken("token")->plainTextToken,
                'comentario' => $comentarios
            ], 201); // Código de estado HTTP 201 para indicar éxito en la creación
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            // En caso de error, devolver una respuesta JSON con un mensaje de error
            return response()->json([
                'message' => 'Error al registrar el comentario: ' . $e->getMessage(),
                'errors' => $errors
            ], 422); // Código de estado HTTP 422 para indicar una solicitud mal formada debido a errores de validación
        } catch (Exception $e) {
            // En caso de otros errores, devuelve un mensaje genérico de error
            return response()->json([
                'message' => 'Error al registrar el comentario: ' . $e->getMessage()
            ], 500); // Código de estado HTTP 500 para indicar un error del servidor
        } 
      




    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ActualizarComentarios $request, $id): JsonResponse
    {
        try {
            
            $comentarios = Comentarios::findOrFail($id);
 
            $data = $request->validated();
 
            
            $comentarios->update([
                'id_evaluacion' => $data['id_evaluacion'],
                'id_usuario' => $data['id_usuario'],
                'contenido' => $data['contenido'],
                'fecha' => $data['fecha'],
                'estado' => $data['estado'], 
        
            ]);
 
            return response()->json([
                'message' => 'Evaluacion registrado correctamente',
                'token' => $comentarios->createToken("token")->plainTextToken,
                'comentarios' => $comentarios
            ], 201); // Código de estado HTTP 201 para indicar éxito en la creación

           
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'el comentario no existe'], 404);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            // En caso de error, devolver una respuesta JSON con un mensaje de error
            return response()->json([
                'message' => 'Error al actualizar el comentario: ' . $e->getMessage(),
                'errors' => $errors
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        try {
            // Encuentra el usuario por su ID
            $comentarios = Comentarios::findOrFail($id);
            // Verificar si el usuario existe
            if (!$comentarios) {
                return response()->json([
                    'message' => 'el comenmtario no existe'
                ], 404); // Código de estado HTTP 404 para indicar que el recurso no se encontró
            }
 
            // Si el usuario existe, intentar eliminarlo
            $comentarios->delete();
 
            return response()->json([
                'message' => 'Comentario eliminada correctamente',
            ]);
        } catch (Exception $e) {
            // En caso de error, devolver una respuesta JSON con un mensaje de error
            return response()->json([
                'message' => 'Error al eliminar el comentario: ' . $e->getMessage()
            ], 500); // Código de estado HTTP 500 para indicar un error del servidor
        }
    }
}

