<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\Review;
use App\Models\Category;
use App\Observers\ReviewObserver;
use App\Observers\OrderObserver; 
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; 
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Review::observe(ReviewObserver::class);
        Order::observe(OrderObserver::class);
        View::share('sharedCategories', Category::all());
        Paginator::defaultView('vendor.pagination.karyalokal');
    }
}
