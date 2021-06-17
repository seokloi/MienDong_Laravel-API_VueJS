<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChuXe_BenXeResource extends JsonResource
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
            'id_BenXe' => $this->id_BenXe,
            'BenXe' => $this->benxe->Ten,
            'DiaDiem1' => $this->benxe->tuyen->DiaDiem1,
            'DiaDiem2' => $this->benxe->tuyen->DiaDiem2,
            'id_ChuXe' => $this->id_ChuXe,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
