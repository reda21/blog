<?php

namespace App\Broadcasting;

use App\Models\User;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Notification;

class TestChannel implements ShouldBroadcast
{
    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        // Send notification to the $notifiable instance...
        $message = $notification->toVoice($notifiable);

        dd($message);
    }
}
