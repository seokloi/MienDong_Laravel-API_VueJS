<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKhachHangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('khachhangs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Ten');
            $table->date('NgaySinh');
            $table->string('DiaChi');
            $table->string('SDT');
            $table->integer('SoLanMua')->default(0);
            $table->integer('id_Loai')->unsigned();
            $table->biginteger('id_User')->unsigned();
            $table->timestamps();
            $table->foreign('id_Loai')->references('id')->on('loaikhachhangs');
            $table->foreign('id_User')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('khachhangs');
    }
}
