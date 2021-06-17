<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//---------------API-----------------------//
    Route::group(['prefix'=>'thanhtoan'], function(){
        Route::post('/', 'ThanhToanController@Checkout');
        Route::get('/', 'ThanhToanController@Result');
    });
    Route::group(['prefix'=>'donggop'], function(){
        Route::get('/', 'DongGopController@index');
        Route::get('/{product}', 'DongGopController@show');
        Route::post('/', 'DongGopController@store');
        Route::put('/{product}', 'DongGopController@update');
        Route::delete('/{product}', 'DongGopController@delete');
    });

    Route::group(['prefix'=>'blog'], function(){
        Route::get('/', 'BlogController@index');
        Route::get('/{product}', 'BlogController@show');
        Route::post('/', 'BlogController@store');
        Route::put('/{product}', 'BlogController@update');
        Route::delete('/{product}', 'BlogController@delete');
    });

    Route::group(['prefix'=>'tuyen'], function(){
        Route::get('/', 'TuyenController@index');
        Route::get('/{product}', 'TuyenController@show');
        Route::post('/', 'TuyenController@store');
        Route::put('/{product}', 'TuyenController@update');
        Route::delete('/{product}', 'TuyenController@delete');
    });

    Route::group(['prefix'=>'benxe'], function(){
        Route::get('/', 'BenXeController@index');
        Route::get('/{product}', 'BenXeController@show');
        Route::post('/', 'BenXeController@store');
        Route::put('/{product}', 'BenXeController@update');
        Route::delete('/{product}', 'BenXeController@delete');
    });

    Route::group(['prefix'=>'chuxe'], function(){
        Route::get('/', 'ChuXeController@index');
        Route::get('/{product}', 'ChuXeController@show');
        Route::post('/', 'ChuXeController@store');
        Route::put('/{product}', 'ChuXeController@update');
        Route::delete('/{product}', 'ChuXeController@delete');
    });

    Route::group(['prefix'=>'xe'], function(){
        Route::get('/', 'XeController@index');
        Route::get('/{product}', 'XeController@show');
        Route::post('/', 'XeController@store');
        Route::put('/{product}', 'XeController@update');
        Route::delete('/{product}', 'XeController@delete');
    });

    Route::group(['prefix'=>'nhanvien'], function(){
        Route::get('/', 'NhanVienController@index');
        Route::get('/{product}', 'NhanVienController@show');
        Route::post('/', 'NhanVienController@store');
        Route::put('/{product}', 'NhanVienController@update');
        Route::delete('/{product}', 'NhanVienController@delete');
    });

    Route::group(['prefix'=>'khachhang'], function(){
        Route::get('/', 'KhachHangController@index');
        Route::get('/{product}', 'KhachHangController@show');
        Route::post('/', 'KhachHangController@store');
        Route::put('/{product}', 'KhachHangController@update');
        Route::delete('/{product}', 'KhachHangController@delete');
    });

    Route::group(['prefix'=>'loaixe'], function(){
        Route::get('/', 'LoaiXeController@index');
        Route::get('/{product}', 'LoaiXeController@show');
        Route::post('/', 'LoaiXeController@store');
        Route::put('/{product}', 'LoaiXeController@update');
        Route::delete('/{product}', 'LoaiXeController@delete');
    });

    Route::group(['prefix'=>'chucvu'], function(){
        Route::get('/', 'ChucVuController@index');
        Route::get('/{product}', 'ChucVuController@show');
        Route::post('/', 'ChucVuController@store');
        Route::put('/{product}', 'ChucVuController@update');
        Route::delete('/{product}', 'ChucVuController@delete');
    });

    Route::group(['prefix'=>'chuxe_benxe'], function(){
        Route::get('/', 'ChuXe_BenXeController@index');
        Route::get('/{product}', 'ChuXe_BenXeController@show');
        Route::post('/', 'ChuXe_BenXeController@store');
        Route::put('/{product}', 'ChuXe_BenXeController@update');
        Route::delete('/{product}', 'ChuXe_BenXeController@delete');
    });

    Route::group(['prefix'=>'loaikhachhang'], function(){
        Route::get('/', 'LoaiKhachHangController@index');
        Route::get('/{product}', 'LoaiKhachHangController@show');
        Route::post('/', 'LoaiKhachHangController@store');
        Route::put('/{product}', 'LoaiKhachHangController@update');
        Route::delete('/{product}', 'LoaiKhachHangController@delete');
    });

    Route::group(['prefix'=>'nv_banve'], function(){
        Route::get('/', 'NV_BanVeController@index');
        Route::get('/{product}', 'NV_BanVeController@show');
        Route::post('/', 'NV_BanVeController@store');
        Route::put('/{product}', 'NV_BanVeController@update');
        Route::delete('/{product}', 'NV_BanVeController@delete');
    });

    Route::group(['prefix'=>'chuyenxe'], function(){
        Route::get('/', 'ChuyenXeController@index');
        Route::get('/{product}', 'ChuyenXeController@show');
        Route::post('/', 'ChuyenXeController@store');
        Route::put('/{product}', 'ChuyenXeController@update');
        Route::delete('/{product}', 'ChuyenXeController@delete');
    });

    Route::group(['prefix'=>'quay'], function(){
        Route::get('/', 'QuayController@index');
        Route::get('/{product}', 'QuayController@show');
        Route::post('/', 'QuayController@store');
        Route::put('/{product}', 'QuayController@update');
        Route::delete('/{product}', 'QuayController@delete');
    });
    //---------------API-----------------------//

Route::group(['namespace' => 'Api', 'as' => 'api.'], function () {

    Route::post('login', 'LoginController@login')->name('login');

    Route::post('register', 'RegisterController@register')->name('register');

    Route::post('password', 'PasswordController@password')->name('password');

    Route::group(['middleware' => ['auth:api']], function () {

        Route::get('user', 'AuthenticationController@user')->name('user');

        Route::post('logout', 'LoginController@logout')->name('logout');

    });

});
