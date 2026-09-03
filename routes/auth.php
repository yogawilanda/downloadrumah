<?php

/**
 * <meta_config>
 * @path : routes/auth.php | usage: Authentication Routes Definitions
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Livewire\Pages\Auth\AuthModal;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Route::get('login', AuthModal::class)->name('login');

    // Redirect route register agar tetap menunjuk ke Gate Utama (AuthModal) dengan tab register aktif
    Route::get('register', function () {
        return redirect()->route('login', ['mode' => 'register']);
    })->name('register');

    Volt::route('forgot-password', 'pages.auth.forgot-password')
        ->name('password.request');

    Volt::route('reset-password/{token}', 'pages.auth.reset-password')
        ->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Volt::route('verify-email', 'pages.auth.verify-email')
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Volt::route('confirm-password', 'pages.auth.confirm-password')
        ->name('password.confirm');
});
