<?php
/**
 * Created by PhpStorm.
 * User: fatah
 * Date: 22/02/2017
 * Time: 10:45
 */

namespace App\Services\Websocket;


use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version1X;
use ElephantIO\Engine\SocketIO\Version2X;

class Socket
{

    private $data = "";

    private $user = null;

    private $channel = null;

    public $connections;

    private $event;
    /**
     * @var string
     */
    private $url;

    /**
     * @param mixed $data
     */

    public function __construct($url = "http://localhost:1445")
    {
        $encode = \Firebase\JWT\JWT::encode([
            "server" => "good"
        ], "mon_super_cle");
        $this->connections = new Client(new Version2X($url, [
            'headers' => [
                'X-My-Header: websocket rocks',
                'token:'.$encode
            ]
        ]));
        $this->url = $url;
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @param null $channel
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;
        return $this;
    }


    public function emit()
    {
        $this->connections->initialize();

        if ($this->channel && is_string($this->channel)) {
            if ($this->channel != "/") {
                $this->connections->of($this->channel);
            }
        }

        if ($this->user) {
            $this->connections->emit($this->event, ['data' => $this->data, "username" => $this->user]);
        } else {
            $this->connections->emit($this->event, ['data' => $this->data]);
        }
        $this->connections->close();
    }

    /**
     * @param mixed $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
        return $this;
    }


}
