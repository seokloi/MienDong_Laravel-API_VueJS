<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nv_banve extends Model
{
    //
    protected $table = 'nv_banves';
    protected $fillable = [
    	'id_Chuyen', 'id_NhanVien', 'Ghe', 'id_KhachHang', 'TenKhachHang', 'SDT', 'Code', 'TienCoc', 'Email'
    ];

    public function nhanvien(){
        return $this->belongsTo('App\nhanvien', 'id_NhanVien', 'id');
    }
    public function khachhang(){
        return $this->belongsTo('App\khachhang', 'id_KhachHang', 'id');
    }
    public function chuyenxe(){
        return $this->belongsTo('App\chuyenxe', 'id_Chuyen', 'id');
    }
}
