<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loaixe extends Model
{
    //
    protected $table = 'loaixes';
    protected $fillable = [
    	'Ten', 'SoGhe', 'SoDoGhe'
    ];
	public function xe(){
        return $this->hasMany('App\xe', 'id', 'id_Loai');
    }
}
