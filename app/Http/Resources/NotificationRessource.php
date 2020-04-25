<?php

namespace App\Http\Resources;

use App\Services\Notifications\Notification;
use cebe\markdown\GithubMarkdown;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $notification = app(Notification::class);
        $label = $notification->parse($this);

        return [
            "id" => $this->id,
            "logo" => $this->notifiable->avatar ? asset($this->notifiable->avatar) : asset("img/profile_images/default.jpg"),
            "url" => route("notifications.read", ['id' => $this->id]),
            'label' => $label,
            "label_strip" => strip_tags($label),
            'read' => !is_null($this->read_at),
            'create_at' => $this->created_at->timestamp
        ];
    }
}
