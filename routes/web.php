<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;



// Customer Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'index'])->name('dashboard');

    Route::get('/bookings', [BookingController::class, 'customerIndex'])->name('customer.bookings');
    Route::get('/bookings/{id}', [BookingController::class, 'showBooking'])->name('customer.booking.show');
    Route::get('/bookings/history/{id}', [BookingController::class, 'showBookingHistory'])->name('customer.booking.history.show');
    Route::get('/bookings/create/{id}', [BookingController::class, 'showBookingForm'])->name('customer.booking.create');

    Route::get('/vehicles/details/{id}', [VehicleController::class, 'showDetails'])->name('customer.vehicles.show.details');
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('customer.vehicles.index');
});

//Admin Routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/bookings', [BookingController::class, 'adminIndex'])->name('admin.bookings');
    Route::get('/vehicles', [VehicleController::class, 'adminVehicleIndex'])->name('admin.vehicles');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    
    Route::post('/vehicles/store', [VehicleController::class, 'store'])->name('admin.vehicles.store');
    Route::post('/bookings/{id}/approve', [BookingController::class, 'approveBooking'])->name('admin.bookings.approve');
    Route::post('/bookings/{id}/reject', [BookingController::class, 'rejectBooking'])->name('admin.bookings.reject');
    Route::post('/bookings/{id}/complete', [BookingController::class, 'completeBooking'])->name('admin.bookings.complete');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
