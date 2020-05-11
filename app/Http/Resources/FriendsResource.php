<?php

namespace App\Http\Resources;

use App\Services\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class FriendsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'fullname' => $this->present()->fullName,
            'url' => $this->present()->urlProfile,
            "avatar" => asset($this->avatar),
            "status" => Helper::ProfileStatus($this->id, auth()->id(), false),
            "date" => $this->updated_at->timestamp
        ];
    }
}
