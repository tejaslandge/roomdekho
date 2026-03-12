<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TenantController;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $role = auth()->user()->role;

        return redirect()->route($role.'.dashboard');
    })->name('dashboard');

    // Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('users.index');
        Route::get('/payments', [AdminController::class, 'payments'])->name('payments.index');
        Route::get('/maintenance', [AdminController::class, 'maintenance'])->name('maintenance.index');
        Route::get('/messages', [AdminController::class, 'messages'])->name('messages.index');
        Route::get('/agreements', [AdminController::class, 'agreements'])->name('agreements.index');
        Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::resource('properties', PropertyController::class);
        Route::resource('rooms', RoomController::class);
        Route::resource('bookings', BookingController::class);
        Route::patch('/bookings/{booking}/status/{status}', [BookingController::class, 'updateStatus'])->name('bookings.update-status');
    });

    // Owner Routes
    Route::middleware(['role:owner'])->prefix('owner')->name('owner.')->group(function () {
        Route::get('/dashboard', [OwnerController::class, 'index'])->name('dashboard');
        Route::get('/payments', [OwnerController::class, 'payments'])->name('payments.index');
        Route::get('/messages', [OwnerController::class, 'messages'])->name('messages.index');
        Route::get('/maintenance', [OwnerController::class, 'maintenance'])->name('maintenance.index');
        Route::get('/agreements', [OwnerController::class, 'agreements'])->name('agreements.index');
        Route::get('/profile', [OwnerController::class, 'profile'])->name('profile');
        Route::resource('properties', PropertyController::class);
        Route::resource('rooms', RoomController::class);
        Route::resource('bookings', BookingController::class);
        Route::patch('/bookings/{booking}/status/{status}', [BookingController::class, 'updateStatus'])->name('bookings.update-status');
    });

    // Tenant Routes
    Route::middleware(['role:tenant'])->prefix('tenant')->name('tenant.')->group(function () {
        Route::get('/dashboard', [TenantController::class, 'index'])->name('dashboard');
        Route::get('/search', [RoomController::class, 'search'])->name('rooms.search');
        Route::get('/favourites', [TenantController::class, 'favourites'])->name('favourites.index');
        Route::get('/messages', [TenantController::class, 'messages'])->name('messages.index');
        Route::get('/rent', [TenantController::class, 'rent'])->name('rent.index');
        Route::get('/maintenance', [TenantController::class, 'maintenance'])->name('maintenance.index');
        Route::get('/profile', [TenantController::class, 'profile'])->name('profile');
        Route::resource('bookings', BookingController::class);
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
