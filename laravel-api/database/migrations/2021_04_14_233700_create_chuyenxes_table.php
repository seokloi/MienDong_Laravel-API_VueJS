<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChuyenXesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chuyenxes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_Xe')->unsigned();
            $table->integer('id_BenXe')->unsigned();
            $table->date('Ngay')->nullable();
            $table->time('Gio');
            $table->integer('GiaVe');
            $table->integer('Hidden')->default(0);
            $table->integer('Printed')->default(0);
            $table->integer('DayInMonth')->nullable();
            $table->timestamps();
            $table->foreign('id_Xe')->references('id')->on('xes');
            $table->foreign('id_BenXe')->references('id')->on('benxes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chuyenxes');
    }
}
