<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChuXeBenXesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chuxe_benxes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_BenXe')->unsigned()->nullable();
            $table->integer('id_ChuXe')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('id_ChuXe')->references('id')->on('chuxes');
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
        Schema::dropIfExists('chuxe_benxes');
    }
}
