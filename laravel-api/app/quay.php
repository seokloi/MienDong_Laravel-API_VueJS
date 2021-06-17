<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quay extends Model
{
    //
    protected $table = 'quays';
    protected $fillable = [
    	'Ten'
    ];
	public function tuyen(){
        return $this->hasMany('App\tuyen', 'id', 'id_Quay');
    }
    public function nhanvien(){
        return $this->hasMany('App\nhanvien', 'id', 'id_Quay');
    }
}
