<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chuxe_benxe extends Model
{
    //
    protected $table = 'chuxe_benxes';

    protected $fillable = [
    	'id_BenXe', 'id_ChuXe'
    ];

    public function chuxe(){
        return $this->belongsTo('App\chuxe', 'id_ChuXe', 'id');
    }
    public function benxe(){
        return $this->belongsTo('App\benxe', 'id_BenXe', 'id');
    }
}
