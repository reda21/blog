<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MailResetConfirmationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var User User
     */
    private User $user;

    /**
     * @var string token
     */
    private string $token;
    /**
     * @var string
     */
    private string $newEmail;

    /**
     * Create a new event instance.
     * @param User $user
     * @param string $token
     * @param string $newEmail
     */
    public function __construct(User $user,string $token,string $newEmail)
    {

        $this->user = $user;
        $this->token = $token;
        $this->newEmail = $newEmail;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {

        return new PrivateChannel('channel-name');
    }
}
