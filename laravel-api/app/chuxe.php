<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chuxe extends Model
{
    //
    protected $table = 'chuxes';

    protected $fillable = [
    	'Ten', 'DiaChi', 'SDT', 'id_User', 'id_Quay'
    ];

	public function xe(){
        return $this->hasMany('App\xe', 'id', 'id_ChuXe');
    }
    public function User(){
        return $this->belongsTo('App\User', 'id_User', 'id');
    }
    public function quay(){
        return $this->belongsTo('App\quay', 'id_Quay', 'id');
    }
}
