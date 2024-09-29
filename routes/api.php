<?php

use App\Http\Controllers\CarsController;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function () {
    // return 1;
    try {
        return DB::select('select * from test');
    } catch (\Exception $e) {
        die("Could not connect to the database.  Please check your configuration. error:" . $e);
    }
});
