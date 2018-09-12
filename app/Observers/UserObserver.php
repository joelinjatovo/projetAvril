<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Label;
use App\Models\Mail;
use App\Models\MailUser;
use App\Models\Observation;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use App\Models\Page;
use App\Models\Search;
use App\Models\Type;

class UserObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function created(User $user)
    {
        //
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  User  $user
     * @return void
     */
    public function deleting(User $user)
    {
        // Update blog data
        Blog::where('author_id', $user->id)->update(['author_id' => 0]);
        
        // Update category data
        Category::where('author_id', $user->id)->update(['author_id' => 0]);
        
        // Delete Comment data
        Comment::where('user_id', $user->id)->delete();
        
        // Delete Label data
        Label::where('author_id', $user->id)->delete();
        
        // Delete Mail data
        Mail::where('sender_id', $user->id)->delete();
        
        // Delete MailUser data
        MailUser::where('user_id', $user->id)->delete();
        
        // Delete Observation data
        Observation::where('author_id', $user->id)->delete();
        
        // Delete Invoice data
        Invoice::where('to_id', $user->id)->delete();
        Invoice::where('from_id', $user->id)->delete();
        
        // Delete orders data
        Order::where('author_id', $user->id)->delete();
        Order::where('seller_id', $user->id)->delete();
        Order::where('cancelled_by', $user->id)->delete();
        Order::where('apl_paid_by', $user->id)->delete();
        Order::where('apl_id', $user->id)->delete();
        
        // Update OR Delete product data
        Product::where('author_id', $user->id)->update(['author_id' => 0]);
        Product::where('seller_id', $user->id)->delete();
        
        // Update page data
        Page::where('author_id', $user->id)->update(['author_id' => 0]);
        
        // Update Search data
        Search::where('author_id', $user->id)->update(['author_id' => 0]);
        
        // Update Type data
        Type::where('author_id', $user->id)->update(['author_id' => 0]);
    }
}
