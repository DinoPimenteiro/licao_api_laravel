<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SapatosController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/sapato', [SapatosController::class, 'store']);

Route::get('/sapatos', [SapatosController::class, 'index']);

Route::get('/sapato/{id}', [SapatosController::class, 'show']);

Route::put('/sapato/{id}', [SapatosController::class, 'update']);

Route::delete('/sapato/{id}', [SapatosController::class, 'destroy']);
