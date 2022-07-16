<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/auth/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/auth/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/auth/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

Route::put('/akun/editData/{id}', [\App\Http\Controllers\Api\AuthController::class, 'updateDataAkun']);
Route::put('/akun/change/password/{id}', [\App\Http\Controllers\Api\AuthController::class, 'updatePassword']);

Route::get('/reservations/{id}', [\App\Http\Controllers\Api\ReservationController::class, 'index']);
Route::get('/reservations/details/{id}', [\App\Http\Controllers\Api\ReservationController::class, 'details']);
Route::post('/reservasi/add/reservations', [\App\Http\Controllers\Api\ReservationController::class, 'store']);
Route::delete('/reservasi/delete/reservation/{code}', [\App\Http\Controllers\Api\ReservationController::class, 'delete']);
