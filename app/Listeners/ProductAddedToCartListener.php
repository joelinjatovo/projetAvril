<?php

namespace App\Listeners;

use App\Events\ProductAddedToCartEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductAddedToCartListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProductAddedToCartEvent  $event
     * @return void
     */
    public function handle(ProductAddedToCartEvent $event)
    {
        //
    }
}
