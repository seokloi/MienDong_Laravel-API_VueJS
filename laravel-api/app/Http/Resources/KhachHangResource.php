<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KhachHangResource extends JsonResource
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
            'email' => $this->user->email,
            'NgaySinh' => $this->NgaySinh,
            'DiaChi' => $this->DiaChi,
            'SDT' => $this->SDT,
            'SoLanMua' => $this->SoLanMua,
            'password' => $this->User->password,
            'ChucVu' => $this->User->chucvu->Ten,
            'id_Loai' => $this->id_Loai,
            'Loai' => $this->loaikhachhang->Ten,
            'GiamGia' => $this->loaikhachhang->GiamGia,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
