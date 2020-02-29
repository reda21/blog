<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

class  User extends JsonResource
{
    /**
     * @OA\Schema(
     *     schema="User",
     *     description="Model User",
     *     @OA\Property(type="integer", properties="id"),
     *     @OA\Property(type="string", properties="name"),
     *     @OA\Property(type="string", properties="email"),
     *     @OA\Property(type="string", format="date-time", properties="created_at")
     *     @OA\Property(type="string", format="date-time", properties="updated_at")
     * )
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
