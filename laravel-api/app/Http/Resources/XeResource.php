<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class XeResource extends JsonResource
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
            'BienSo' => $this->BienSo,
            'SoGhe' => $this->loaixe->SoGhe,
            'Loai' => $this->loaixe->Ten,
            'id_Loai' => $this->id_Loai,
            'id_ChuXe' => $this->id_ChuXe,
            'ChuXe' => $this->chuxe->Ten,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
