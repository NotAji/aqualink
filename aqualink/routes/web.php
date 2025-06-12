<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FishController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//role routes
Route::get('/dashboard', function () {

    return match (Auth::user()->role) {
        'admin' => redirect('/admin/dashboard'),
        default => redirect('/user/dashboard'),
    };
})->middleware('auth')->name('dashboard');

Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('user');

//Admin Controllers
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/browse', [AdminController::class, 'browse'])->name('admin.browse');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/user-management', [AdminController::class, 'userManagement'])->name('admin.user-management');
    Route::get('/admin/reports', [AdminController::class, 'reports'])->name('admin.reports');
    Route::delete('/admin/user-management-delete{id}', [AdminController::class, 'removeUser'])->name('admin.remove-user');
    Route::delete('/admin/remove-reports{id}', [AdminController::class, 'removeFishOnReports'])->name('admin.remove-reports');
});

//profile controllers
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Fish Controllers
Route::middleware(['auth'])->group(function () {
    Route::get('/user/myfish', [FishController::class, 'index'])->name('user.myfish');
    Route::get('/user/dashboard', [FishController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/create', [FishController::class, 'create'])->name('user.create');
    Route::post('user/create', [FishController::class, 'store'])->name('user.store');
    Route::get('user/{id}/edit', [FishController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [FishController::class, 'update'])->name('user.update');
    Route::delete('/user/myfish{id}', [FishController::class, 'destroy'])->name('user.destroy');
    Route::post('/user/report{id}', [FishController::class, 'reportFish'])->name('user.report');
});

//Booking Controllers
Route::middleware(['auth'])->group(function () {
    Route::get('user/browse', [BookingController::class, 'browse'])->name('user.browse');
    Route::get('/user/mybooking', [BookingController::class, 'index'])->name('user.mybooking');
    Route::get('/user/{id}/bookFish', [BookingController::class, 'bookFish'])->name('user.bookFish');
    Route::post('/user/{id}/storeBooking', [BookingController::class, 'storeBooking'])->name('user.storeBooking');
    Route::delete('/user/mybooking{id}', [BookingController::class, 'destroyBooking'])->name('user.destroyBooking');
    Route::put('/user/mybooking/{id}/decline', [BookingController::class, 'declineBooking'])->name('user.declineBooking');
    Route::put('/user/mybooking/{id}/approve', [BookingController::class, 'approveBooking'])->name('user.approveBooking');
});

require __DIR__ . '/auth.php';
