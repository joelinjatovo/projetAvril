<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  Product $product
     * @return void
     */
    public function created(Product $product)
    {
        //
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  Product $product
     * @return void
     */
    public function deleting(Product $product)
    {
        //
    }
}
