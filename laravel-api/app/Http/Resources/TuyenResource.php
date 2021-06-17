<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TuyenResource extends JsonResource
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
            'DiaDiem1' => $this->DiaDiem1,
            'DiaDiem2' => $this->DiaDiem2,
            'DoDai' => $this->DoDai,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
