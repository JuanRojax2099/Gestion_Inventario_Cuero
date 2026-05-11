<?php
//Resulta poco practico utiizar un login mediante la tranferencia de datos en API.
//La api sera utilizada para la gestion de objetos.
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntregasController;
use App\Http\Controllers\SignController;

// Rutas CRUD para Entregas
Route::prefix('entregas')->group(function () {
    Route::get('/', [EntregasController::class, 'GetEntregas']);              
    Route::post('/', [EntregasController::class, 'store']);                  
    Route::put('/{id}', [EntregasController::class, 'update']);             
    Route::delete('/{id}', [EntregasController::class, 'destroy']);            
    Route::get('/{id}', [EntregasController::class, 'show']);              
});

Route::get('/facturas/{id}', [EntregasController::class, 'showFactura']);
