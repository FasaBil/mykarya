<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CompetitionController;
use App\Http\Controllers\Admin\SubmissionVerificationController;
use App\Http\Controllers\User\SubmissionController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::prefix('admin')->name('admin.')->group(function() {
        Route::resource('categories', CategoryController::class);
        Route::resource('competitions', CompetitionController::class);
        
        Route::get('verifications', [SubmissionVerificationController::class, 'index'])->name('verifications.index');
        Route::put('verifications/{submission}', [SubmissionVerificationController::class, 'update'])->name('verifications.update');
    });
    
    Route::prefix('user')->name('user.')->group(function() {
        Route::resource('submissions', SubmissionController::class);
    });
});
