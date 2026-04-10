<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignController;
use App\Http\Controllers\EntregasController;

#Route::get('/loka',[SignController::class,'show_history']);
#Route::get('/login',function(){return 'Hola';});
/** Rutas de la guia 5 API REST*/
Route::post('/register',[SignController::class,'store']);
Route::post('/validation',[SignController::class,'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/landing',[SignController::class,'landingIndex']);
});

Route::get('/usertest', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

#Rutas para Entregas sin autenticación
Route::get('/entregas', [EntregasController::class, 'GetEntregas']);
Route::post('/guardar', [EntregasController::class, 'store']);
Route::delete('/entregas/{id}', [EntregasController::class, 'destroy']);
