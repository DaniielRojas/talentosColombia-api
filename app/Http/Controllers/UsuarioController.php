<?php
 
namespace App\Http\Controllers;
 
use App\Http\Requests\ActualizarUsuarioRequest;
use App\Http\Requests\CrearUsuarioRequest;
use App\Models\Usuario;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
 
class UsuarioController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            // Obtener todos los usuarios
            $usuarios = Usuario::all();
 
            // Devolver la respuesta JSON con los usuarios
            return response()->json([
                'usuarios' => $usuarios
            ]);
        } catch (Exception $e) {
            // En caso de error, devolver una respuesta JSON con un mensaje de error
            return response()->json([
                'message' => 'Error al obtener los usuarios: ' . $e->getMessage()
            ], 500); // Código de estado HTTP 500 para indicar un error del servidor
        }
    }
 
    public function show($id): JsonResponse
    {
        try {
            // Buscar el usuario por su ID
            $usuario = Usuario::findOrFail($id);
 
            // Devolver el usuario encontrado en formato JSON
            return response()->json([
                'usuario' => $usuario
            ]);
        } catch (ModelNotFoundException $e) {
            // Manejar la excepción si el usuario no existe
            return response()->json(['message' => 'El usuario no existe'], 404);
        } catch (Exception $e) {
            // Manejar cualquier otro error y devolver una respuesta de error
            return response()->json([
                'message' => 'Error al obtener el usuario: ' . $e->getMessage()
            ], 500);
        }
    }
 
    public function store(CrearUsuarioRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            // Crear un nuevo usuario con los datos proporcionados
            $usuario = usuario::create([
                'nombre' => $data['nombre'],
                'apellido' => $data['apellido'],
                'numero_documento' => $data['numero_documento'],
                'nombre_usuario' => $data['nombre_usuario'],
                'fecha_nacimiento' => $data['fecha_nacimiento'],
                'direccion' => $data['direccion'],
                'documento_id' => $data['documento_id'],
                'rol_id' => $data['rol_id'],
                'imagen' => $data['imagen'],
                'correo' => $data['correo'],
                'contrasena' => bcrypt($data['contrasena']),
            ]);
 
            return response()->json([
                'message' => 'Usuario registrado correctamente',
                'token' => $usuario->createToken("token")->plainTextToken,
                'usuario' => $usuario
            ], 201); // Código de estado HTTP 201 para indicar éxito en la creación
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            // En caso de error, devolver una respuesta JSON con un mensaje de error
            return response()->json([
                'message' => 'Error al registrar el usuario: ' . $e->getMessage(),
                'errors' => $errors
            ], 422); // Código de estado HTTP 422 para indicar una solicitud mal formada debido a errores de validación
        } catch (Exception $e) {
            // En caso de otros errores, devuelve un mensaje genérico de error
            return response()->json([
                'message' => 'Error al registrar el usuario: ' . $e->getMessage()
            ], 500); // Código de estado HTTP 500 para indicar un error del servidor
        }
    }
 
    public function update(ActualizarUsuarioRequest $request, $id): JsonResponse
    {
        try {
            // Encuentra el usuario por su ID
            $usuario = Usuario::findOrFail($id);
 
            $data = $request->validated();
 
            // Actualizar el usuario con los datos proporcionados
            $usuario->update([
                'nombre' => $data['nombre'],
                'apellido' => $data['apellido'],
                'numero_documento' => $data['numero_documento'],
                'nombre_usuario' => $data['nombre_usuario'],
                'fecha_nacimiento' => $data['fecha_nacimiento'],
                'direccion' => $data['direccion'],
                'documento_id' => $data['documento_id'],
                'rol_id' => $data['rol_id'],
                'imagen' => $data['imagen'],
                'correo' => $data['correo'],
        
            ]);
 
            return response()->json([
                'message' => 'Usuario registrado correctamente',
                'token' => $usuario->createToken("token")->plainTextToken,
                'usuario' => $usuario
            ], 201); // Código de estado HTTP 201 para indicar éxito en la creación

           
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'El usuario no existe'], 404);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            // En caso de error, devolver una respuesta JSON con un mensaje de error
            return response()->json([
                'message' => 'Error al actualizar el usuario: ' . $e->getMessage(),
                'errors' => $errors
            ], 422);
        }
    }
 
    public function destroy($id): JsonResponse
    {
        try {
            // Encuentra el usuario por su ID
            $usuario = Usuario::findOrFail($id);
            // Verificar si el usuario existe
            if (!$usuario) {
                return response()->json([
                    'message' => 'El usuario no existe'
                ], 404); // Código de estado HTTP 404 para indicar que el recurso no se encontró
            }
 
            // Si el usuario existe, intentar eliminarlo
            $usuario->delete();
 
            return response()->json([
                'message' => 'Usuario eliminado correctamente',
            ]);
        } catch (Exception $e) {
            // En caso de error, devolver una respuesta JSON con un mensaje de error
            return response()->json([
                'message' => 'Error al eliminar el usuario: ' . $e->getMessage()
            ], 500); // Código de estado HTTP 500 para indicar un error del servidor
        }
    }
}
 
