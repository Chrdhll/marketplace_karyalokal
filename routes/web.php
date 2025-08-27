<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Freelancer\GigController;
use App\Http\Controllers\Freelancer\ProfilFreelanceController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/single-product', [PageController::class, 'singleProduct'])->name('single-product');
Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');
Route::get('/category', [PageController::class, 'category'])->name('category');
Route::get('/confirmation', [PageController::class, 'confirmation'])->name('confirmation');
Route::get('/', [PageController::class, 'index'])->name('index');

Route::post('/contact', [PageController::class, 'contactProccess'])->name('contact-proccess');

// Route::get('/', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth','verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->prefix('freelancer')->name('freelancer.')->group(function () {
    Route::get('/profil', [ProfilFreelanceController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfilFreelanceController::class, 'update'])->name('profil.update');

    Route::resource('gigs', GigController::class)->middleware('approved.freelancer');
});

Route::get('/auth/google/redirect', [SocialiteController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback'])->name('google.callback');

require __DIR__ . '/auth.php';
