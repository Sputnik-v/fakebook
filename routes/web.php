<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->middleware('guest')->name('home');

Route::get('/dashboard', [UserController::class, 'index'])->middleware('auth')->name('dashboard');

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'store'])->name('login.store');
});


    Route::get('email/verify', [EmailController::class, 'create'])->middleware('auth')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', [EmailController::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('email/verification-notification', [EmailController::class, 'send'])->middleware(['auth', 'throttle:3,1'])->name('verification.send');

Route::middleware('auth')->group(function (){
   Route::get('logout', [LoginController::class, 'logout'])->name('logout');
   Route::post('image', [PhotoController::class, 'store'])->name('image.store');
   Route::get('update', [UserController::class, 'updateUser'])->name('update.user');
});



