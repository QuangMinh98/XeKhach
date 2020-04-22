<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLotrinh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lotrinh', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('noidi');
            $table->string('noiden');
            $table->integer('khoangcach');
            $table->unsignedBigInteger('idXe');
            $table->unsignedBigInteger('idTinhDi');
            $table->unsignedBigInteger('idTinhDen');
            $table->foreign('idXe')->references('id')->on('xe');
            $table->foreign('idTinhDi')->references('id')->on('tinhdi');
            $table->foreign('idTinhDen')->references('id')->on('tinhden');
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
        Schema::dropIfExists('lotrinh');
    }
}
