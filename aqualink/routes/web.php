<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FishController;
use App\Http\Controllers\BookingController;
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

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin');

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
});

//Booking Controllers
Route::middleware(['auth'])->group(function () {
    Route::get('user/browse', [BookingController::class, 'browse'])->name('user.browse');
    Route::get('/user/mybooking', [BookingController::class, 'index'])->name('user.mybooking');
    Route::get('/user/{id}/bookFish', [BookingController::class, 'bookFish'])->name('user.bookFish');
    Route::post('/user/{id}/storeBooking', [BookingController::class, 'storeBooking'])->name('user.storeBooking');
});

require __DIR__ . '/auth.php';
