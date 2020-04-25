<?php


namespace App\Services\Websocket;

use Illuminate\Broadcasting\Broadcasters\Broadcaster;

class SocketBroadcaster extends Broadcaster
{

    /**
     * Broadcaster constructor.
     */
    public function __construct()
    {
    }

    public function auth($request)
    {
        // TODO: Implement auth() method.
    }

    public function validAuthenticationResponse($request, $result)
    {
        // TODO: Implement validAuthenticationResponse() method.
    }

    public function broadcast(array $channels, $event, array $payload = [])
    {
        // TODO: Implement broadcast() method.
    }
}
