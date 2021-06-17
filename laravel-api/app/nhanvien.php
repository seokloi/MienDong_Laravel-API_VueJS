<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nhanvien extends Model
 {
    protected $table = 'nhanviens';

    protected $fillable = [
        'Ten', 'NgaySinh', 'DiaChi', 'SDT', 'NgayBatDauHopDong', 'id_Quay', 'id_User'
    ];

    public function User(){
        return $this->belongsTo('App\User', 'id_User', 'id');
    }
    public function quay(){
        return $this->belongsTo('App\quay', 'id_Quay', 'id');
    }
    public function nv_banve(){
        return $this->hasMany('App\nv_banve', 'id', 'id_NhanVien');
    }
}
