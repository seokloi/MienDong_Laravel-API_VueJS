<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chuyenxe extends Model
{
    //
    protected $table = 'chuyenxes';
    protected $fillable = [
    	'id_Xe', 'id_BenXe', 'Ngay', 'Gio', 'GiaVe', 'Hidden', 'Printed', 'DayInMonth'
    ];

    public function xe(){
        return $this->belongsTo('App\xe', 'id_Xe', 'id');
    }
    public function benxe(){
        return $this->belongsTo('App\benxe', 'id_BenXe', 'id');
    }
    public function nv_banve(){
        return $this->hasMany('App\nv_banve', 'id', 'id_Chuyen');
    }
}
