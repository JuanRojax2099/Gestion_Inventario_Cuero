<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usercontroller;

Route::get('/', function () {
    return view('index');
});
Route::get('/enlace', [usercontroller::class, 'index'])->name('enlace');
Route::get('/landing', function () {
    return view('landing');
});
Route::get('/historial', function () {
    return view('history');
});
Route::get('/calendario', function () {
    return view('schedule');
});