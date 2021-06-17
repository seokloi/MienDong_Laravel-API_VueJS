<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tuyen extends Model
{
    //
    protected $table = 'tuyens';

    protected $fillable = [
    	'DiaDiem1', 'DiaDiem2', 'DoDai'
    ];

	public function benxe(){
        return $this->hasMany('App\benxe', 'id', 'id_Tuyen');
    }
    
}
