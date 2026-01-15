<?php

use App\Http\Controllers\Api\V1\CarController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {

    Route::apiResource('cars', CarController::class)
        ->only(['index', 'show']);

    Route::middleware('auth:sanctum')->group(function () {

        Route::apiResource('cars', CarController::class)
            ->only(['store', 'update', 'destroy']);

    });

});



require __DIR__ . '/auth.php';

