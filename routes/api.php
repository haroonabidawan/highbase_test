<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('login', [App\Http\Controllers\API\Auth\LoginController::class, 'login']);
Route::middleware('auth:sanctum')->group(function (): void {
    Route::get('/user-details', [App\Http\Controllers\API\Auth\UserController::class, 'userDetails']);
    Route::post('/logout', [App\Http\Controllers\API\Auth\LoginController::class, 'logout']);
});
