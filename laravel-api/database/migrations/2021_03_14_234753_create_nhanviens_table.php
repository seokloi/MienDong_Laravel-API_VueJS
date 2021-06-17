<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNhanViensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhanviens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Ten');
            $table->date('NgaySinh');
            $table->string('DiaChi');
            $table->string('SDT');
            $table->date('NgayBatDauHopDong');
            $table->integer('id_Quay')->unsigned()->nullable();
            $table->biginteger('id_User')->unsigned();
            $table->timestamps();
            $table->foreign('id_Quay')->references('id')->on('quays');
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
        Schema::dropIfExists('nhanviens');
    }
}
