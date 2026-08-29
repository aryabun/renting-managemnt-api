<?php

use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UnitTypeController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::get('/status', [StatusController::class, 'index']);
Route::get('/property-type', [PropertyTypeController::class, 'index']);
Route::get('/unit-type', [UnitTypeController::class, 'index']);
