<?php

namespace App\Listeners;

use App\Events\WebsocketEvent;
use App\Http\Resources\NotificationRessource;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Notifications\DatabaseNotification;

class NotificationListener
{
    public function subscribe($events)
    {
        $events->listen('eloquent.created: Illuminate\Notifications\DatabaseNotification', [$this, 'createNotification']);

        $events->listen('eloquent.updated: Illuminate\Notifications\DatabaseNotification', [$this, 'createNotification']);

        $events->listen('eloquent.deleted: Illuminate\Notifications\DatabaseNotification', [$this, 'deleteNotification']);
    }


    public function createNotification(DatabaseNotification $model)
    {
        $user = $model->notifiable;
        $data = (new NotificationRessource($model))->jsonSerialize();
        event(new WebsocketEvent("add_notification_server", $data, $user->username));
    }

    public function deleteNotification(DatabaseNotification $model)
    {
        $user = $model->notifiable;
        event(new WebsocketEvent("delete_notification_server", $model->id, $user->username));
    }
}
