<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableXe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xe', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tenxe');
            $table->string('mauxe');
            $table->integer('sotang');
            $table->integer('soghe');
            $table->text('mota');
            $table->string('biensoxe');
            $table->string('tinhtrang');
            $table->text('img');
            $table->unsignedBigInteger('idtuyen');
            $table->unsignedBigInteger('idloaixe');
            $table->unsignedBigInteger('idHang');
            $table->foreign('idtuyen')->references('id')->on('tuyen');
            $table->foreign('idloaixe')->references('id')->on('loaixe');
            $table->foreign('idHang')->references('id')->on('hang');
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
        Schema::dropIfExists('xe');
    }
}
