<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loaikhachhang extends Model
{
    //
    protected $table = 'loaikhachhangs';
    protected $fillable = [
    	'Ten', 'GiamGia'
    ];

	public function khachhang(){
        return $this->hasMany('App\khachhang', 'id', 'id_Loai');
    }
}
