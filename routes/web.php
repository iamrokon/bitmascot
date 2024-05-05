<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile-view', [UserController::class, 'profile'])->name('profile-view');
    Route::get('/password-update', [UserController::class, 'passwordUpdateForm'])->name('password-update');
    Route::post('/password-update', [UserController::class, 'passwordUpdate'])->name('password-update');
    Route::post('/logout', [UserController::class, 'userLogout'])->name('user.logout');
    Route::get('/admin', [UserController::class, 'index'])->name('admin');
    Route::post('/search', [UserController::class, 'search'])->name('search');
});


Route::get('/', [UserController::class, 'loginView'])->name('loginView');
Route::get('/signup', [UserController::class, 'signup'])->name('signup');
Route::post('/check-email', [UserController::class, 'checkEmail'])->name('check.email');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::get('/verify-otp', [UserController::class, 'verifyOtpForm'])->name('verify.otp.form');
Route::post('/verify-otp', [UserController::class, 'verifyOtp'])->name('verify.otp');
// require __DIR__.'/auth.php';
