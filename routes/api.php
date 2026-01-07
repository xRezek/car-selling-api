<?php

use App\Http\Controllers\Api\V1\CarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/helloworld', function(){
    
    return ["message" => "Hello world from laravel API"];

});

Route::prefix('v1')->group(function(){

    Route::apiResource('cars', CarController::class);

});

require __DIR__.'/auth.php';

