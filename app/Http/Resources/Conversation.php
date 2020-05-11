<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Conversation extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            "body" => $this->body,
            "conversation_id" => $this->conversation_id,
            "sender" => new ParticipationUserResource($this->sender),
            "created_at" => $this->created_at->timestamp
        ];
    }
}
