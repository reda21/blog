<?php
/**
 * Created by PhpStorm.
 * User: fatah
 * Date: 22/02/2017
 * Time: 12:57
 */

namespace App\Services\Websocket;


use Illuminate\Support\Facades\Facade;

class SocketFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'Socket';
    }

}
