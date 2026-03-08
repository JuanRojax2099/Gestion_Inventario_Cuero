<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/landing', function () {
    return view('landing');
});
Route::get('/historial', function () {
    return view('history');
});
Route::get('/calendario', function () {
    return view('schedule');
});