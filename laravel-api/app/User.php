<?php

namespace App;

use App\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'name', 'email', 'password', 'id_ChucVu',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function chucvu(){
        return $this->belongsTo('App\chucvu', 'id_ChucVu', 'id');
    }
    public function nhanvien(){
        return $this->belongsTo('App\nhanvien', 'id', 'id_User');
    }
    public function khachhang(){
        return $this->belongsTo('App\khachhang', 'id', 'id_User');
    }
    public function chuxe(){
        return $this->belongsTo('App\chuxe', 'id', 'id_User');
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail());
    }
}
