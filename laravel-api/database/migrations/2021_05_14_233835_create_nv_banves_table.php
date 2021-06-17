<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNvBanvesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nv_banves', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_Chuyen')->unsigned();
            $table->string('Ghe');
            $table->integer('id_NhanVien')->unsigned()->nullable();
            $table->integer('id_KhachHang')->unsigned()->nullable();
            $table->string('TenKhachHang')->nullable();
            $table->string('SDT')->nullable();
            $table->string('Email')->nullable();
            $table->string('Code')->nullable();
            $table->integer('TienCoc')->default(0);
            $table->timestamps();
            $table->foreign('id_NhanVien')->references('id')->on('nhanviens');
            $table->foreign('id_KhachHang')->references('id')->on('khachhangs');
            $table->foreign('id_Chuyen')->references('id')->on('chuyenxes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nv_banves');
    }
}
