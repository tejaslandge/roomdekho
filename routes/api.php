<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Property Routes
    Route::apiResource('properties', \App\Http\Controllers\Api\PropertyApiController::class);

    Route::get('/rooms/search', [\App\Http\Controllers\Api\RoomApiController::class, 'search']);
    Route::get('/rooms/{room}', [\App\Http\Controllers\Api\RoomApiController::class, 'show']);

    // Booking Routes
    Route::apiResource('bookings', \App\Http\Controllers\Api\BookingApiController::class);
    Route::put('/bookings/{booking}/status', [\App\Http\Controllers\Api\BookingApiController::class, 'updateStatus']);

    // Payment Routes
    Route::get('/payments', [\App\Http\Controllers\Api\PaymentApiController::class, 'index']);
    Route::post('/payments', [\App\Http\Controllers\Api\PaymentApiController::class, 'store']);

    // Message Routes
    Route::get('/conversations', [\App\Http\Controllers\Api\MessageApiController::class, 'conversations']);
    Route::get('/conversations/{conversation}/messages', [\App\Http\Controllers\Api\MessageApiController::class, 'messages']);
    Route::post('/messages', [\App\Http\Controllers\Api\MessageApiController::class, 'sendMessage']);

    // Favourite Routes
    Route::post('/favourites/toggle', [\App\Http\Controllers\Api\FavouriteApiController::class, 'toggle']);

    // OTP Verification Routes
    Route::post('/email/verify-otp', [AuthController::class, 'verifyOtp'])
        ->middleware(['throttle:6,1'])
        ->name('verification.verify.otp');

    Route::post('/email/resend-otp', [AuthController::class, 'resendOtp'])
        ->middleware(['throttle:6,1'])
        ->name('verification.resend.otp');
});
