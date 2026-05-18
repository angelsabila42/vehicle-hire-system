<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReviewController;



// Customer Routes
Route::middleware(['auth','customer'])->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'index'])->name('dashboard');

    Route::get('/bookings', [BookingController::class, 'customerIndex'])->name('customer.bookings');
    Route::get('/bookings/{id}', [BookingController::class, 'showBooking'])->name('customer.booking.show');
    Route::get('/bookings/history/{id}', [BookingController::class, 'showBookingHistory'])->name('customer.booking.history.show');
    Route::get('/bookings/create/{id}', [BookingController::class, 'showBookingForm'])->name('customer.booking.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::patch('/bookings/{id}/cancel', [BookingController::class, 'cancelBooking'])->name('customer.booking.cancel');
    Route::post('/bookings/{id}/review', [ReviewController::class, 'store'])->name('bookings.review.store');

    Route::get('/vehicles/details/{id}', [VehicleController::class, 'showDetails'])->name('customer.vehicles.show.details');
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('customer.vehicles.index');
});

//Admin Routes
Route::middleware(['auth','admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/bookings', [BookingController::class, 'adminIndex'])->name('admin.bookings');
    Route::get('/vehicles', [VehicleController::class, 'adminVehicleIndex'])->name('admin.vehicles');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    
    Route::post('/vehicles/store', [VehicleController::class, 'store'])->name('admin.vehicles.store');
    Route::put('/vehicles/{id}', [VehicleController::class, 'update'])->name('admin.vehicles.update');
    Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])->name('admin.vehicles.destroy');
    Route::post('/bookings/{id}/approve', [BookingController::class, 'approveBooking'])->name('admin.bookings.approve');
    Route::post('/bookings/{id}/reject', [BookingController::class, 'rejectBooking'])->name('admin.bookings.reject');
    Route::post('/bookings/{id}/complete', [BookingController::class, 'completeBooking'])->name('admin.bookings.complete');

    Route::patch('/settings/notifications', [AdminController::class, 'updateSettings'])->name('admin.settings.update');
    Route::delete('/settings/notifications/locations/{id}', [AdminController::class, 'destroyLocation'])->name('admin.locations.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Notification Routes
    Route::get('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
    Route::delete('/notifications/clear', [NotificationController::class, 'clearAll'])->name('notifications.clear');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.delete');
    Route::get('/welcome', function () {
    return view('welcome');
});
    
});






require __DIR__.'/auth.php';
