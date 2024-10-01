<?php

use App\Http\Controllers\CarsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);

Route::get('/cars', [CarsController::class, 'index']);
Route::get('/cars/{id}', [CarsController::class, 'getCarDetails']);
