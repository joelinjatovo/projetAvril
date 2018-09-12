<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Laravel\Cashier\Cashier;
use App\Observers\UserObserver;
use App\Observers\ProductObserver;
use App\Models\User;
use App\Models\Product;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        
        // Cashier
        Cashier::useCurrency('eur', '€');
        
        // Migration
        Schema::defaultStringLength(191);
        
        // User
        User::observe(UserObserver::class);
        
        // Product
        Product::observe(ProductObserver::class);
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
