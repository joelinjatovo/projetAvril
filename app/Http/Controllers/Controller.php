<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Auth;
use Session;
use App;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    /**
     * Pagination records per page
     */
    protected $pageSize = 12;
    
    /**
     * Recent records size
     */
    protected $recentSize = 4;
    
    /**
     * Array of distances
     */
    protected $distances = [10, 20, 50, 100, 200, 500, 1000];
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
}
