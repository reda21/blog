<?php

namespace App\Providers;

use App\Services\Websocket\SocketBroadcaster;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::extend('alpha', function ($broadcasting, $config){
            return new SocketBroadcaster();
        });
    }
}
