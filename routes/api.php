<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignController;

#Route::get('/loka',[SignController::class,'show_history']);
#Route::get('/login',function(){return 'Hola';});
Route::post('/register',[SignController::class,'store']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/login',[SignController::class,'login']);
});

Route::get('/usertest', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
