<?php
/**
 * Created by PhpStorm.
 * User: fatah
 * Date: 22/02/2017
 * Time: 10:51
 */

namespace App\Services\Websocket;


use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class SocketProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    public function register()
    {
        $this->registerSearch();


        $this->app->alias('Socket', Socket::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function registerSearch()
    {


        $this->app->singleton("Socket", function ($app) {
            $socketUrl = config("app.socketUrl", "http://localhost:1445");
            return new Socket($socketUrl);
        });
    }

}
