<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BenXeResource extends JsonResource
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
            'id_Tuyen' => $this->id_Tuyen,
            'DiaDiem1' => $this->tuyen->DiaDiem1,
            'DiaDiem2' => $this->tuyen->DiaDiem2,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
