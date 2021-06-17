<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class xe extends Model
{
    //
    protected $table = 'xes';
    protected $fillable = [
    	'BienSo', 'id_Loai', 'id_ChuXe'
    ];

    public function chuxe(){
        return $this->belongsTo('App\chuxe', 'id_ChuXe', 'id');
    }
	public function chuyenxe(){
        return $this->hasMany('App\chuyenxe', 'id', 'id_Xe');
    }
    public function loaixe(){
        return $this->belongsTo('App\loaixe', 'id_Loai', 'id');
    }
}
