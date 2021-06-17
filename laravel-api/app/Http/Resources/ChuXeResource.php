<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChuXeResource extends JsonResource
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
            'DiaChi' => $this->DiaChi,
            'SDT' => $this->SDT,
            'id_User' => $this->id_User,
            'email' => $this->User->email,
            'password' => $this->User->password,
            'id_Quay' => $this->id_Quay,
            'Quay' => $this->quay->Ten,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
