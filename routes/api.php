<?php

use App\Http\Controllers\EvaluacionesController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ComentariosController;
use App\Http\Controllers\NotasEstudiantesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::apiResource('/usuarios',UsuarioController::class) ;
Route::apiResource('/evaluaciones',EvaluacionesController::class) ;
Route::apiResource('/comentarios',ComentariosController::class) ;
Route::apiResource('/notas-estudiantes', NotasEstudiantesController::class) ;

