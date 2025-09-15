<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PublicGigController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Freelancer\GigController;
use App\Http\Controllers\PublicFreelancerController;
use App\Http\Controllers\Freelancer\DashboardController;
use App\Http\Controllers\Freelancer\ProfilFreelanceController;
use App\Http\Controllers\Freelancer\OrderController as FreelancerOrderController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/single-product', [PageController::class, 'singleProduct'])->name('single-product');
Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');
Route::get('/category', [PageController::class, 'category'])->name('category');
Route::get('/confirmation', [PageController::class, 'confirmation'])->name('confirmation');
Route::get('/', [PageController::class, 'index'])->name('index');

Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::post('/contact', [PageController::class, 'contactProccess'])->name('contact-proccess');

Route::get('/freelancers/{user:username}', [PublicFreelancerController::class, 'show'])->name('public.freelancer.show');

Route::get('/gigs/{gig}', [PublicGigController::class, 'show'])->name('public.gigs.show');

Route::get('/gigs', [PublicGigController::class, 'index'])->name('public.gigs.index');

// Route untuk menerima notifikasi dari Midtrans
Route::post('/midtrans-webhook', [WebhookController::class, 'handle'])->name('midtrans.webhook');

// Route::get('/', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user->role == 'admin') {
            return redirect('/admin');
        }
        if ($user->role == 'freelancer') {
            return redirect()->route('freelancer.dashboard');
        }

        // Untuk client atau role lain, arahkan ke halaman utama
        return redirect()->route('index');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route untuk menampilkan daftar pesanan milik klien
    Route::get('/my-orders', [OrderController::class, 'index'])->name('order.index');
    // Route untuk memproses pembuatan pesanan baru
    // Route::post('/order/{gig}', [OrderController::class, 'store'])->name('order.store');

    Route::get('/checkout/{gig}', [OrderController::class, 'checkout'])->name('checkout')->middleware('role.client');
    Route::post('/checkout/{gig}', [OrderController::class, 'processCheckout'])->name('checkout.process')->middleware('role.client');


    Route::post('/reviews/{order}', [ReviewController::class, 'store'])->name('reviews.store');

    // routes/web.php
    Route::get('/orders/{order}/download', [OrderController::class, 'downloadDelivery'])->name('order.download');

    // routes/web.php
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('order.show');

    Route::post('/orders/{order}/messages', [OrderController::class, 'postMessage'])->name('order.messages.store');

    Route::post('/wishlist/{gig}/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
});

Route::middleware(['auth', 'verified'])->prefix('freelancer')->name('freelancer.')->group(function () {
    Route::get('/profil', [ProfilFreelanceController::class, 'show'])->name('profil.show');
    Route::get('/profil/edit', [ProfilFreelanceController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfilFreelanceController::class, 'update'])->name('profil.update');

    Route::resource('gigs', GigController::class)->middleware('approved.freelancer');

    Route::get('/orders', [FreelancerOrderController::class, 'index'])->name('orders.index');

    Route::post('/orders/{order}/deliver', [FreelancerOrderController::class, 'deliverWork'])->name('orders.deliver');
    Route::patch('/orders/{order}/update-status', [FreelancerOrderController::class, 'updateStatus'])->name('orders.updateStatus');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/auth/google/redirect', [SocialiteController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback'])->name('google.callback');

require __DIR__ . '/auth.php';
