<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Reservation\ReservationController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/health', function (Request $request) {
    return response()->json(['status' => 'ok']);
})->name('health');

Route::apiResource('users', UserController::class)
    ->middleware('auth:sanctum')
    ->except(['index', 'destroy', 'store']);
Route::apiResource('reservartions', ReservationController::class)->middleware('auth:sanctum');
Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('register', [UserController::class, 'store'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::middleware('auth:sanctum')->delete('logout', [AuthController::class, 'logout'])->name('logout');
});
