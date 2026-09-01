<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SubUnitController;
use App\Http\Controllers\UnitTypeController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('properties', PropertyController::class);
    Route::post('/properties/{property}/invite', [PropertyController::class, 'invite']);

    Route::get('/properties/{property}/units', [SubUnitController::class, 'index']);
    Route::post('/properties/{property}/units', [SubUnitController::class, 'store']);
    Route::patch('/units/{unit}', [SubUnitController::class, 'update']);
    Route::delete('/units/{unit}', [SubUnitController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/status', [StatusController::class, 'index']);
    Route::get('/property-type', [PropertyTypeController::class, 'index']);
    Route::get('/unit-type', [UnitTypeController::class, 'index']);
    // Route::middleware('role:super_admin')->group(function () {
    //     Route::get('/admin/users', [AdminController::class, 'index']);
    // });
});
