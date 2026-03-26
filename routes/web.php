<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usercontroller;
use App\Http\Controllers\SignController;

Route::get('/', function () {
    return view('index');
});
Route::post('/login',[SignController::class,'login'])->name('login');
#Route::get('/enlace', [usercontroller::class, 'index'])->name('enlace');
Route::get('/landing', function () {
    return view('landing');
})->middleware('auth');
Route::get('/historial', function () {
    return view('history');
});
Route::get('/calendario', function () {
    return view('schedule');
});