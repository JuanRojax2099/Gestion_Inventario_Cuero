<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usercontroller;
use App\Http\Controllers\SignController;
use App\Http\Controllers\EntregasController;
Route::get('/Login', function () {
    return view('index');
});
Route::get('/', function () {
    return view('index');
});
Route::post('/validate', [SignController::class, 'loginWeb'])->name('validate');
Route::post('/logout', [SignController::class, 'logout'])->name('logout');
Route::middleware('auth')->group(function () {
    Route::get('/landing', function(){
        return view('landing');
    });
    Route::get('/historial', function () {
        return view('history');
    });
    Route::get('/calendario', function () {
        return view('schedule');
    })->name('calendario');
});
