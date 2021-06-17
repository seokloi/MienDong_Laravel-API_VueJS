<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chucvu extends Model
{
    //
    protected $table = 'chucvus';

    protected $fillable = [
    	'Ten'
    ];

	public function User(){
        return $this->hasMany('App\User', 'id', 'id_ChucVu');
    }
}
