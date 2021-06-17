<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NhanVienResource extends JsonResource
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
            'email' => $this->User->email,
            'NgaySinh' => $this->NgaySinh,
            'DiaChi' => $this->DiaChi,
            'SDT' => $this->SDT,
            'NgayBatDauHopDong' => $this->NgayBatDauHopDong,
            'password' => $this->User->password,
            'id_Quay' => $this->id_Quay,
            'Quay' => $this->quay->Ten,
            'ChucVu' => $this->user->chucvu->Ten,
            'id_User' => $this->id_User,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
