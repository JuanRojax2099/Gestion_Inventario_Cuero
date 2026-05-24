<?php
//Resulta poco practico utiizar un login mediante la tranferencia de datos en API.
//La api sera utilizada para la gestion de objetos.
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntregasController;
use App\Http\Controllers\InsumosController;
use App\Http\Controllers\ProductoDetailController;
use App\Models\insumos;

Route::get('insumo/{id}', [InsumosController::class, 'show']);
Route::put('insumo/{id}', [InsumosController::class, 'update']);
Route::delete('insumo/{id}', [InsumosController::class, 'destroy']);

Route::get('producto/{id}', [ProductoDetailController::class, 'showApi']);
Route::put('producto/{id}', [ProductoDetailController::class, 'update']);
Route::delete('producto/{id}', [ProductoDetailController::class, 'destroy']);

// Rutas CRUD para Entregas.
Route::prefix('entregas')->group(function () {
    Route::get('/', [EntregasController::class, 'GetEntregas']);              
    Route::post('/', [EntregasController::class, 'store']);                  
    Route::put('/{id}', [EntregasController::class, 'update']);             
    Route::delete('/{id}', [EntregasController::class, 'destroy']);            
    Route::get('/{id}', [EntregasController::class, 'show']);              
});

Route::get('/facturas/{id}', [EntregasController::class, 'showFactura']);
