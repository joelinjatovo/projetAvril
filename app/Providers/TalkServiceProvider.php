<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\MessageRepository;
use App\Repositories\ThreadRepository;
use App\Talk\Talk;
use App;

class TalkServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('talk', function(){
            return new Talk(new ThreadRepository(), new MessageRepository());
        });
    }
}
