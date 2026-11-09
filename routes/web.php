<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TenantController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AgreementController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PwaController;
use App\Http\Controllers\Admin\SiteSettingsController;


Route::get('/', [HomeController::class, 'index'])->name('home');

// PWA manifest + offline shell (public, no auth).
Route::get('/manifest.webmanifest', [PwaController::class, 'manifest'])->name('pwa.manifest');
Route::get('/offline', [PwaController::class, 'offline'])->name('pwa.offline');

// Public Room Routes
Route::get('/search', [RoomController::class, 'search'])->name('rooms.search');
Route::get('/rooms', [RoomController::class, 'search'])->name('rooms.index');
Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');

// Public product documentation
Route::get('/documentation', function () {
    return view('documentation');
})->name('documentation');

Route::middleware(['auth', 'verified'])->group(function () {
    // Verification Routes (Common)
    Route::get('/verifications', [\App\Http\Controllers\UserVerificationController::class, 'index'])->name('verifications.index');
    Route::get('/verifications/create', [\App\Http\Controllers\UserVerificationController::class, 'create'])->name('verifications.create');
    Route::post('/verifications', [\App\Http\Controllers\UserVerificationController::class, 'store'])->name('verifications.store');

    Route::get('/dashboard', function () {
        $role = Auth::user()->role;

        return redirect()->route($role . '.dashboard');
    })->name('dashboard');

    // Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/users/{user}', [AdminController::class, 'showUser'])->name('users.show');
        Route::get('/users', [AdminController::class, 'users'])->name('users.index');
        Route::get('/payments', [AdminController::class, 'payments'])->name('payments.index');
        Route::get('/maintenance', [AdminController::class, 'maintenance'])->name('maintenance.index');
        Route::get('/messages', [AdminController::class, 'messages'])->name('messages.index');
        Route::get('/agreements', [AgreementController::class, 'index'])->name('agreements.index');
        Route::get('/agreements/{agreement}', [AgreementController::class, 'show'])->name('agreements.show');
        Route::post('/agreements/{agreement}/terminate', [AgreementController::class, 'terminate'])->name('agreements.terminate');
        Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
        Route::get('/settings', [SiteSettingsController::class, 'general'])->name('settings');
        Route::put('/settings', [SiteSettingsController::class, 'updateGeneral'])->name('settings.update');
        Route::get('/settings/branding', [SiteSettingsController::class, 'branding'])->name('settings.branding');
        Route::put('/settings/branding', [SiteSettingsController::class, 'updateBranding'])->name('settings.branding.update');
        Route::get('/settings/pwa', [SiteSettingsController::class, 'pwa'])->name('settings.pwa');
        Route::put('/settings/pwa', [SiteSettingsController::class, 'updatePwa'])->name('settings.pwa.update');
        Route::get('/settings/appearance', [SiteSettingsController::class, 'appearance'])->name('settings.appearance');
        Route::put('/settings/appearance', [SiteSettingsController::class, 'updateAppearance'])->name('settings.appearance.update');
        Route::get('/settings/seo', [SiteSettingsController::class, 'seo'])->name('settings.seo');
        Route::put('/settings/seo', [SiteSettingsController::class, 'updateSeo'])->name('settings.seo.update');
        Route::resource('properties', PropertyController::class);
        Route::resource('rooms', RoomController::class);
        Route::resource('bookings', BookingController::class);
        Route::patch('/bookings/{booking}/status/{status}', [BookingController::class, 'updateStatus'])->name('bookings.update-status');

        // Admin Verification Management
        Route::get('/verifications', [\App\Http\Controllers\UserVerificationController::class, 'adminIndex'])->name('verifications.admin-index');
        Route::patch('/verifications/{verification}/approve', [\App\Http\Controllers\UserVerificationController::class, 'approve'])->name('verifications.approve');
        Route::patch('/verifications/{verification}/reject', [\App\Http\Controllers\UserVerificationController::class, 'reject'])->name('verifications.reject');
    });

    // Owner Routes
    Route::middleware(['role:owner'])->prefix('owner')->name('owner.')->group(function () {
        Route::get('/dashboard', [OwnerController::class, 'index'])->name('dashboard');
        Route::get('/payments', [OwnerController::class, 'payments'])->name('payments.index');
        Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{conversation}', [MessageController::class, 'show'])->name('messages.show');
        Route::post('/messages/{conversation}/send', [MessageController::class, 'store'])->name('messages.send');
        Route::get('/maintenance', [OwnerController::class, 'maintenance'])->name('maintenance.index');
        Route::get('/agreements', [AgreementController::class, 'index'])->name('agreements.index');
        Route::get('/agreements/{agreement}', [AgreementController::class, 'show'])->name('agreements.show');
        Route::post('/agreements/{agreement}/terminate', [AgreementController::class, 'terminate'])->name('agreements.terminate');
        Route::get('/profile', [OwnerController::class, 'profile'])->name('profile');
        Route::resource('properties', PropertyController::class);
        Route::resource('rooms', RoomController::class);
        Route::resource('bookings', BookingController::class);
        Route::patch('/bookings/{booking}/status/{status}', [BookingController::class, 'updateStatus'])->name('bookings.update-status');
    });

    // Tenant Routes
    Route::middleware(['role:tenant'])->prefix('tenant')->name('tenant.')->group(function () {
        Route::get('/dashboard', [TenantController::class, 'index'])->name('dashboard');
        Route::get('/favourites', [TenantController::class, 'favourites'])->name('favourites.index');
        Route::post('/favourites/{room}/toggle', [TenantController::class, 'toggleFavourite'])->name('favourites.toggle');
        Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{conversation}', [MessageController::class, 'show'])->name('messages.show');
        Route::post('/messages/{conversation}/send', [MessageController::class, 'store'])->name('messages.send');
        Route::get('/rooms/{room}/chat', [MessageController::class, 'start'])->name('rooms.chat');
        Route::get('/rent', [TenantController::class, 'rent'])->name('rent.index');
        Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
        Route::get('/payments/{booking}/pay', [PaymentController::class, 'pay'])->name('payments.pay');
        Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
        Route::get('/maintenance', [TenantController::class, 'maintenance'])->name('maintenance.index');
        Route::get('/profile', [TenantController::class, 'profile'])->name('profile');
        Route::get('/agreements', [AgreementController::class, 'index'])->name('agreements.index');
        Route::get('/agreements/{agreement}', [AgreementController::class, 'show'])->name('agreements.show');
        Route::post('/agreements/{agreement}/terminate', [AgreementController::class, 'terminate'])->name('agreements.terminate');
        Route::resource('bookings', BookingController::class);
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
