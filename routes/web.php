<?php

use App\Http\Controllers\CarsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuotesController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);

Route::get('/cars', [CarsController::class, 'index']);
Route::get('/cars/store', [CarsController::class, 'storeCars']);

Route::get('/cars/{id}', [CarsController::class, 'getCarDetails']);
Route::post('/quotes/sync', [QuotesController::class, 'syncCarQuotes']);
