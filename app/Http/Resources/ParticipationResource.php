<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class ParticipationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $user = User::find($this->messageable_id);
        return [
            "id" => $user->id,
            "username" => $user->username,
            "fullname" => $user->present()->fullName,
            "url" => asset($user->present()->url),
            "avatar" => asset($user->present()->avatar),
        ];
    }
}
