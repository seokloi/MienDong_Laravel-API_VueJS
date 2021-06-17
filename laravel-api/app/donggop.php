<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class donggop extends Model
{
    //
    protected $table = 'donggops';
    protected $fillable = [
    	'name', 'email', 'sdt', 'noidung'
    ];
}
