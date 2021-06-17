<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('BienSo');
            $table->integer('id_Loai')->unsigned();
            $table->integer('id_ChuXe')->unsigned();
            $table->timestamps();
            $table->foreign('id_ChuXe')->references('id')->on('chuxes');
            $table->foreign('id_Loai')->references('id')->on('loaixes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('xes');
    }
}
