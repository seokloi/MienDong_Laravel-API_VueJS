<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class khachhang extends Model
 {
    protected $table = 'khachhangs';

    protected $fillable = [
        'Ten', 'NgaySinh', 'DiaChi', 'SDT', 'SoLanMua', 'id_Loai', 'id_User'
    ];

    public function loaikhachhang(){
        return $this->belongsTo('App\loaikhachhang', 'id_Loai', 'id');
    }
    public function User(){
        return $this->belongsTo('App\User', 'id_User', 'id');
    }
    public function nv_banve(){
        return $this->hasMany('App\nv_banve', 'id', 'id_KhachHang');
    }
}
