<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BlogController;

class PageController extends BlogController
{
    
    /**
     * Type of Blog in database
     *
     */
    protected $post_type = 'page';
    

}
