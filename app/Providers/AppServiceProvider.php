<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Laravel\Cashier\Cashier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Braintree Configuration
        \Braintree_Configuration::environment(config('services.braintree.environment', 'sandbox'));
        \Braintree_Configuration::merchantId(config('services.braintree.merchant_id', 'fhxxnh27vv8fjwzy'));
        \Braintree_Configuration::publicKey(config('services.braintree.public_key', 'g33tjhcm3z5vb889'));
        \Braintree_Configuration::privateKey(config('services.braintree.private_key', '44e25ec1e8f9ff3a95d6d50a224ca7f9'));
        
        // Cashier
        //Cashier::useCurrency('eur', '€');
        
        // Migration
        Schema::defaultStringLength(191);
        
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
