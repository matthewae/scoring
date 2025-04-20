<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\SubmissionController as GuestSubmissionController;
use App\Http\Controllers\User\SubmissionController as UserSubmissionController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    // Redirect from /home based on user status
    Route::get('/home', function () {
        if (auth()->user()->isGuest()) {
            return redirect()->route('guest.home');
        } elseif (auth()->user()->isUser()) {
            return redirect()->route('user.home');
        }
        return view('home');
    })->name('home');

    // Guest routes
    Route::middleware(['guest'])->prefix('guest')->name('guest.')->group(function () {
        Route::get('/home', function () {
            return view('guest.home');
        })->name('home');
        Route::get('/submissions', [GuestSubmissionController::class, 'index'])->name('submissions.index');
        Route::post('/submissions', [GuestSubmissionController::class, 'store'])->name('submissions.store');
    });

    // User routes
    Route::middleware(['user'])->prefix('user')->name('user.')->group(function () {
        Route::get('/home', function () {
            return view('user.home');
        })->name('home');
        Route::get('/submissions', [UserSubmissionController::class, 'index'])->name('submissions.index');
        Route::post('/submissions/{submission}/score', [UserSubmissionController::class, 'score'])->name('submissions.score');
        Route::get('/submissions/{submission}/download', [UserSubmissionController::class, 'download'])->name('submissions.download');
    });
});

require __DIR__.'/auth.php';
