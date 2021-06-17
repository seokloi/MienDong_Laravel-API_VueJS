<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'Ten' => $this->Ten,
            'NoiDungTomTat' => $this->NoiDungTomTat,
            'NoiDung' => $this->NoiDung,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
