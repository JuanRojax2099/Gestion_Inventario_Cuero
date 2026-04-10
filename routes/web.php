<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usercontroller;
use App\Http\Controllers\SignController;
use App\Http\Controllers\EntregasController;

Route::get('/', function () {
    return view('index');
});

Route::post('/login',[SignController::class,'validation'])->name('login');
Route::get('/landing', function () {
    return view('landing');
})->middleware('auth');

Route::get('/historial', function () {
    return view('history');
});
Route::get('/calendario', function () {
    return view('schedule');
}); 
Route::get('/calendario',[EntregasController::class,'getEntregas'])->name('calendario');
