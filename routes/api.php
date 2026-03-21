<?php
use App\Http\Controllers\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\EventRequest;
use App\Http\Controllers\LoginController;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\VenueController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::apiResource('events', EventController::class) ->middleware('auth:sanctum');

Route::apiResource('venues', VenueController::class) ->middleware('auth:sanctum');

Route::apiResource('phones', PhonesController::class) ->middleware('auth:sanctum');
Route::post('/login', [LoginController::class, 'login']);