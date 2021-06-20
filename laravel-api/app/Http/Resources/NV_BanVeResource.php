<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NV_BanVeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if(isset($this->id_NhanVien))
        {
            if(isset($this->id_KhachHang))
            {
                return [
                'id' => $this->id,
                'id_Chuyen' => $this->id_Chuyen,
                'DiaDiem1' => $this->chuyenxe->benxe->tuyen->DiaDiem1,
                'DiaDiem2' => $this->chuyenxe->benxe->tuyen->DiaDiem2,
                'Ngay' => $this->chuyenxe->Ngay,
                'Gio' => $this->chuyenxe->Gio,
                'Ghe' => $this->Ghe,
                'id_NhanVien' => $this->id_NhanVien,
                'NhanVien' => $this->nhanvien->Ten,
                'id_KhachHang' => $this->id_KhachHang,
                'LoaiKH' => $this->khachhang->loaikhachhang->Ten,
                'TenKhachHang' => $this->TenKhachHang,
                'SDT' => $this->SDT,
                'Email' => $this->Email,
                'Code' => $this->Code,
                'GiaVe' => $this->chuyenxe->GiaVe,
                'TienCoc' => $this->TienCoc,
                'paymenting' => $this->paymenting,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                ];
            }
            else
            {
                return [
                'id' => $this->id,
                'id_Chuyen' => $this->id_Chuyen,
                'DiaDiem1' => $this->chuyenxe->benxe->tuyen->DiaDiem1,
                'DiaDiem2' => $this->chuyenxe->benxe->tuyen->DiaDiem2,
                'Ngay' => $this->chuyenxe->Ngay,
                'Gio' => $this->chuyenxe->Gio,
                'Ghe' => $this->Ghe,
                'id_NhanVien' => $this->id_NhanVien,
                'NhanVien' => $this->nhanvien->Ten,
                'TenKhachHang' => $this->TenKhachHang,
                'SDT' => $this->SDT,
                'Code' => $this->Code,
                'GiaVe' => $this->chuyenxe->GiaVe,
                'TienCoc' => $this->TienCoc,
                'paymenting' => $this->paymenting,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                ];
            }
        }
        else
        {
            if(isset($this->id_KhachHang))
            {
                return [
                'id' => $this->id,
                'id_Chuyen' => $this->id_Chuyen,
                'DiaDiem1' => $this->chuyenxe->benxe->tuyen->DiaDiem1,
                'DiaDiem2' => $this->chuyenxe->benxe->tuyen->DiaDiem2,
                'Ngay' => $this->chuyenxe->Ngay,
                'Gio' => $this->chuyenxe->Gio,
                'Ghe' => $this->Ghe,
                'id_KhachHang' => $this->id_KhachHang,
                'LoaiKH' => $this->khachhang->loaikhachhang->Ten,
                'TenKhachHang' => $this->TenKhachHang,
                'SDT' => $this->SDT,
                'Email' => $this->Email,
                'Code' => $this->Code,
                'GiaVe' => $this->chuyenxe->GiaVe,
                'TienCoc' => $this->TienCoc,
                'paymenting' => $this->paymenting,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                ];
            }
            else
            {
                return [
                'id' => $this->id,
                'id_Chuyen' => $this->id_Chuyen,
                'DiaDiem1' => $this->chuyenxe->benxe->tuyen->DiaDiem1,
                'DiaDiem2' => $this->chuyenxe->benxe->tuyen->DiaDiem2,
                'Ngay' => $this->chuyenxe->Ngay,
                'Gio' => $this->chuyenxe->Gio,
                'Ghe' => $this->Ghe,
                'TenKhachHang' => $this->TenKhachHang,
                'SDT' => $this->SDT,
                'Email' => $this->Email,
                'Code' => $this->Code,
                'GiaVe' => $this->chuyenxe->GiaVe,
                'TienCoc' => $this->TienCoc,
                'paymenting' => $this->paymenting,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                ];
            }
        }
    }
}
