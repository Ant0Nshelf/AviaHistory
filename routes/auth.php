<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Route::view('login', 'auth.login')->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::view('register', 'auth.register')->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('registration/pending', [RegisteredUserController::class, 'pending'])->name('registration.pending');
    Route::get('registration/verify', [RegisteredUserController::class, 'verify'])->name('registration.verify');

    Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');
    Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');

    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])
        ->name('password.reset');
    Route::post('password/reset', [ForgotPasswordController::class, 'reset'])
        ->middleware('throttle:5,1')
        ->name('password.update');

});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationController::class, 'notice'])
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationController::class, 'send'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Volt::route('confirm-password', 'auth.confirm-password')
        ->name('password.confirm');
});

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

