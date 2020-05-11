<?php

namespace App\Http\Resources;

use App\Models\User;
use Composer\Installer\PackageEvent;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $me = $request->user();
        return [
            "id" => $this->id,
            "message" => $this->body,
            "created_at" => $this->created_at->timestamp,
            "sender" => new ParticipationUserResource($this->sender),
            "reader" => $this->is_seen ? true : false,
        ];
    }
}
