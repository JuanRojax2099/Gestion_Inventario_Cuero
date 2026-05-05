<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usercontroller;
use App\Http\Controllers\SignController;
use App\Http\Controllers\EntregasController;
use App\Http\Controllers\InsumosController;
use App\Http\Controllers\ProductoController;
Route::get('/Login', function () {
    return view('index');
});
Route::get('/', function () {
    return view('index');
});
Route::post('/validate', [SignController::class, 'loginWeb'])->name('validate');
Route::post('/logout', [SignController::class, 'logout'])->name('logout');
Route::middleware('auth')->group(function () {
    Route::get('/landing', [App\Http\Controllers\LandingController::class, 'index'])->name('landing');
    Route::get('/historial', function () {
        return view('history');
    });
    Route::get('/calendario', function () {
        return view('schedule');
    })->name('calendario');
    Route::get('/calendario/CrearEntrega',function(){
        return view('Admin.CreateDelivery');
    })->name('CreateDelivery');
    Route::post('/insumos', [InsumosController::class, 'store'])->name('insumos.store');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
});
