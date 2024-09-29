<?php

use App\Http\Controllers\CarsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cars', [CarsController::class, 'index']);
