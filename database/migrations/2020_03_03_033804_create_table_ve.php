<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableVe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ve', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('soghe');
            $table->unsignedBigInteger('idUser');
            $table->unsignedBigInteger('idChuyen');
            $table->integer('tinhtrang');
            $table->integer('thanhtoan');
            $table->foreign('idUser')->references('id')->on('users');
            $table->foreign('idChuyen')->references('id')->on('chuyen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ve');
    }
}
