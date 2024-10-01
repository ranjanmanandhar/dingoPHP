<?php

use App\Http\Controllers\CarsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuotesController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/cars/store', [CarsController::class, 'storeCars']);
Route::delete('/cars', [CarsController::class, 'deleteAllCarsDetails']);

Route::post('/quotes/sync', [QuotesController::class, 'syncCarQuotes']);
