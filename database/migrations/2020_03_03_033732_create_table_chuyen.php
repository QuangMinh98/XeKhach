<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableChuyen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chuyen', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('giodi');
            $table->dateTime('gioden');
            $table->double('giave');
            $table->integer('tinhtrang');
            $table->unsignedBigInteger('idLoTrinh');
            $table->foreign('idLoTrinh')->references('id')->on('lotrinh');
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
        Schema::dropIfExists('chuyen');
    }
}
