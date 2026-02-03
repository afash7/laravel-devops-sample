<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/health', [\App\Http\Controllers\HealthController::class, 'index']);

Route::get('/hello', function () {
    return 'Hello Next.js, from Laravel API';
});
