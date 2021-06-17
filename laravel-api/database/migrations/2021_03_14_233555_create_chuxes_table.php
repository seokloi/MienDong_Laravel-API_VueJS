<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChuxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chuxes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Ten');
            $table->string('DiaChi');
            $table->biginteger('id_User')->unsigned();
            $table->string('SDT');
            $table->integer('id_Quay')->unsigned();
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
        Schema::dropIfExists('chuxes');
    }
}
