<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBenXesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benxes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Ten');
            $table->integer('id_Tuyen')->unsigned();
            $table->timestamps();
            $table->foreign('id_Tuyen')->references('id')->on('tuyens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('benxes');
    }
}
