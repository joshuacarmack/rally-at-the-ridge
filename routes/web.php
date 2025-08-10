<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\RegistrationPageController;
use App\Http\Controllers\Public\RegistrationController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CheckinController;
use App\Http\Controllers\Admin\DrawingController;
use App\Http\Controllers\Admin\VotingController;

// Public
Route::get('/', [RegistrationPageController::class, 'show'])->name('reg.form');
Route::post('/register', [RegistrationController::class, 'store'])->name('reg.store');
Route::get('/thanks', [RegistrationPageController::class, 'thanks'])->name('reg.thanks');

// Admin (Breeze auth)
Route::middleware(['auth'])->prefix('/admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/search', [CheckinController::class, 'search'])->name('search');
    Route::post('/checkin/{car}', [CheckinController::class, 'checkin'])->name('checkin');
    Route::post('/tshirt/{car}', [CheckinController::class, 'shirt'])->name('shirt');
    Route::post('/comment/{car}', [CheckinController::class, 'comment'])->name('comment');
    Route::get('/drawings', [DrawingController::class, 'index'])->name('drawings');
    Route::post('/draw', [DrawingController::class, 'draw'])->name('draw');
    Route::post('/draw/{drawing}/claim', [DrawingController::class, 'claim'])->name('draw.claim');
    Route::get('/voting', [VotingController::class, 'index'])->name('voting');
    Route::post('/voting/submit', [VotingController::class, 'submit'])->name('voting.submit');
    Route::get('/voting/leaderboard', [VotingController::class, 'leaderboard'])->name('voting.leaderboard');
});

require __DIR__.'/auth.php'; // Breeze routes
