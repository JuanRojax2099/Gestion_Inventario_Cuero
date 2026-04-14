<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntregasController;

// Rutas CRUD para Entregas
Route::prefix('entregas')->group(function () {
    Route::get('/', [EntregasController::class, 'GetEntregas']);              
    Route::post('/', [EntregasController::class, 'store']);                  
    Route::put('/{id}', [EntregasController::class, 'update']);             
    Route::delete('/{id}', [EntregasController::class, 'destroy']);            
    Route::get('/{id}', [EntregasController::class, 'show']);              
});
