<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class benxe extends Model
{
    //
    protected $table = 'benxes';

    protected $fillable = [
    	'Ten', 'id_Tuyen'
    ];

	public function chuyenxe(){
        return $this->hasMany('App\chuyenxe', 'id', 'id_BenXe');
    }
    public function tuyen(){
        return $this->belongsTo('App\tuyen', 'id_Tuyen', 'id');
    }
}
