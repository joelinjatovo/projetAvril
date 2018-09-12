<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Label;

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
        // Delete orders data
        Order::where('product_id', $product->id)->delete();
        
        // Delete Label data
        Label::where('product_id', $product->id)->delete();
    }
}
