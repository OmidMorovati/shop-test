<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserGeneralResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name'        => $this->name,
            'lat'         => optional($this->location)->getLat(),
            'lng'         => optional($this->location)->getLng(),
            'email'       => $this->email,
            'permissions' => $this->permissions->pluck('name'),
        ];
    }
}
