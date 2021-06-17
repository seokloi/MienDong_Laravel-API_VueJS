<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\nv_banve;

class ChuyenXeResource extends JsonResource
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
            'id_Xe' => $this->id_Xe,
            'BienSo' => $this->xe->BienSo,
            'id_Loai' => $this->xe->id_Loai,
            'LoaiXe' => $this->xe->loaixe->Ten,
            'SoGhe' => $this->xe->loaixe->SoGhe,
            'id_ChuXe' => $this->xe->id_ChuXe,
            'ChuXe' => $this->xe->chuxe->Ten,
            'SDT' => $this->xe->chuxe->SDT,
            'id_BenXe' => $this->id_BenXe,
            'BenXe' => $this->benxe->Ten,
            'id_Tuyen' => $this->benxe->id_Tuyen,
            'DiaDiem1' => $this->benxe->tuyen->DiaDiem1,
            'DiaDiem2' => $this->benxe->tuyen->DiaDiem2,
            'Ngay' => $this->Ngay,
            'Gio' => $this->Gio,
            'GiaVe' => $this->GiaVe,
            'Hidden' => $this->Hidden,
            'Printed' => $this->Printed,
            'QD_Ghe' => $this->QD_Ghe,
            'QD_SoGhe' => $this->QD_SoGhe,
            'DayInMonth' => $this->DayInMonth,
            'ConLai' => nv_banve::where('id_Chuyen',$this->id)->where('TenKhachHang',NULL)->get()->count(),
            'ThanhTien' => nv_banve::where('id_Chuyen',$this->id)->get()->sum('TienCoc'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
