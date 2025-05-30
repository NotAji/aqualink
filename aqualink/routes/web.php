<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersInventoryController;
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

//usersInventory Controllers
Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [UsersInventoryController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UsersInventoryController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UsersInventoryController::class, 'store'])->name('user.store');
});

require __DIR__ . '/auth.php';
