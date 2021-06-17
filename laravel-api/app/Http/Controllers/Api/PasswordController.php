<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;

class PasswordController extends Controller
{
    public function password(Request $request){
        $this->validate($request, 
        [
            'id_User' => 'required',
            'password' => 'required',
            'passwordAgain' => 'required|same:password'
        ],
        [
            'password.required' => 'Bạn chưa nhập password',
            'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same' => 'Nhập lại mật khẩu không chính xác'
        ]);
        $user = user::findOrFail($request->input('id_User'));
        $user->password = bcrypt($request->input('password'));

        $user->save();
        return response()->json($user, 201);
    }
}
