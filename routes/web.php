<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\PageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PublicGigController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Freelancer\GigController;
use App\Http\Controllers\PublicFreelancerController;
use App\Http\Controllers\Auth\ReactivationController;
use App\Http\Controllers\Freelancer\ReportController;
use App\Http\Controllers\Freelancer\FinanceController;
use App\Http\Controllers\Freelancer\DashboardController;
use App\Http\Controllers\Freelancer\ProfilFreelanceController;
use App\Http\Controllers\Freelancer\OrderController as FreelancerOrderController;
use App\Http\Controllers\Freelancer\ReviewController as FreelancerReviewController;

// Route::get('/', function () {
//     return view('welcome');
// });

    // Route::get('/storage-link', function () {
    //     Artisan::call('storage-link');
    //     return 'Storage Linked Succesfull. ';
    // });

Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/single-product', [PageController::class, 'singleProduct'])->name('single-product');
Route::get('/category', [PageController::class, 'category'])->name('category');
Route::get('/confirmation', [PageController::class, 'confirmation'])->name('confirmation');
Route::get('/', [PageController::class, 'index'])->name('index');

Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::post('/contact', [PageController::class, 'contactProccess'])->name('contact-proccess');

Route::get('/freelancers/{user:username}', [PublicFreelancerController::class, 'show'])->name('public.freelancer.show');

Route::get('/gigs/{gig:slug}', [PublicGigController::class, 'show'])->name('public.gigs.show');

Route::get('/gigs', [PublicGigController::class, 'index'])->name('public.gigs.index');

// Route untuk menerima notifikasi dari Midtrans
Route::post('/midtrans-webhook', [WebhookController::class, 'handle'])->name('midtrans.webhook');

// Route::get('/', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/account/reactivate', [ReactivationController::class, 'showNotice'])->name('reactivate.notice');
Route::post('/account/reactivate', [ReactivationController::class, 'reactivate'])->name('reactivate.process');


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

    Route::get('/checkout/{gig:slug}', [OrderController::class, 'checkout'])->name('checkout')->middleware('can.order');
    Route::post('/checkout/{gig:slug}', [OrderController::class, 'processCheckout'])->name('checkout.process')->middleware('can.order');
    Route::get('/payment/{order:uuid}', [OrderController::class, 'showPayment'])->name('payment.show')->middleware('auth');

    Route::get('/payment/{order:uuid}', [OrderController::class, 'showPayment'])->name('payment.show');
    Route::delete('/orders/{order:uuid}/cancel', [OrderController::class, 'cancel'])->name('order.cancel');

    Route::post('/reviews/{order:uuid}', [ReviewController::class, 'store'])->name('reviews.store');

    // routes/web.php
    Route::get('/orders/{order:uuid}/download', [OrderController::class, 'downloadDelivery'])->name('order.download');

    // routes/web.php
    Route::get('/orders/{order:uuid}', [OrderController::class, 'show'])->name('order.show');

    Route::post('/orders/{order:uuid}/messages', [OrderController::class, 'postMessage'])->name('order.messages.store');

    Route::post('/wishlist/{gig:slug}/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
});

Route::middleware(['auth', 'verified'])->prefix('freelancer')->name('freelancer.')->group(function () {
    Route::get('/profil', [ProfilFreelanceController::class, 'show'])->name('profil.show');
    Route::get('/profil/edit', [ProfilFreelanceController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfilFreelanceController::class, 'update'])->name('profil.update');

    Route::resource('gigs', GigController::class)->middleware('approved.freelancer');

    Route::get('/orders', [FreelancerOrderController::class, 'index'])->name('orders.index')->middleware('approved.freelancer');

    Route::post('/orders/{order:uuid}/deliver', [FreelancerOrderController::class, 'deliverWork'])->name('orders.deliver')->middleware('approved.freelancer');
    Route::patch('/orders/{order:uuid}/update-status', [FreelancerOrderController::class, 'updateStatus'])->name('orders.updateStatus')->middleware('approved.freelancer');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('approved.freelancer');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index')->middleware('approved.freelancer');
    Route::get('/reviews', [FreelancerReviewController::class, 'index'])->name('reviews.index')->middleware('approved.freelancer');


    Route::get('/reports/export/pdf', [ReportController::class, 'exportPdf'])->name('reports.export.pdf')->middleware('approved.freelancer');
    Route::get('/reports/export/excel', [ReportController::class, 'exportExcel'])->name('reports.export.excel')->middleware('approved.freelancer');
    // routes/web.php
    Route::get('/reports/print', [ReportController::class, 'print'])->name('reports.print')->middleware('approved.freelancer');

    // RUTE BARU UNTUK FITUR FINANSIAL
    Route::get('/finance', [FinanceController::class, 'index'])->name('finance.index')->middleware('approved.freelancer');
    ;
    Route::resource('bank-accounts', BankAccountController::class)->only(['store', 'destroy'])->middleware('approved.freelancer');
    ;
    Route::post('/withdrawals', [FinanceController::class, 'requestWithdrawal'])->name('withdrawals.request')->middleware('approved.freelancer');
    ;
});

Route::get('/auth/google/redirect', [SocialiteController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback'])->name('google.callback');

require __DIR__ . '/auth.php';
