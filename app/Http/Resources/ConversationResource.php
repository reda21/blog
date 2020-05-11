<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;
use Chat;

class ConversationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $participant = $this->participants()->where("messageable_id", "!=", $request->user()->id)->first();

        return [
            "id" => $this->id,
            "participant" => new ParticipationResource($participant),
            "data" => new MessageResource($this->last_message),
            "url" => "https://webmx.herokuapp.com/pm/title-game-0",
        ];
    }
}
