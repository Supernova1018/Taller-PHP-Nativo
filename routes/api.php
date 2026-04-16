<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PhonesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Categoria;
use App\Models\Phone;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('events', EventController::class)->names('apievents')->middleware('auth:sanctum');
Route::apiResource('venues', VenueController::class)->names('apivenues')->middleware('auth:sanctum');
Route::apiResource('categorias', CategoriaController::class)->names('apicategorias')->middleware('auth:sanctum');
Route::apiResource('phones', PhonesController::class)->names('apiphones')->middleware('auth:sanctum');
Route::post('/register', [AuthController::class, 'register']);
Route::get('index-active-events', [EventController::class, 'indexActiveEvents'])->middleware('auth:sanctum');
Route::post('/login', [LoginController::class, 'login']);
Route::get('listar-categorias', [CategoriaController::class, 'listarCategorias'])->middleware('auth:sanctum');