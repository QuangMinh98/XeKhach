<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ve extends Model
{
    protected $table = 've';
    protected $fillable = ['idUser','idChuyen','soghe','thanhtoan','tinhtrang'];

    public function chuyenxe(){
    	return $this->belongsTo('App\chuyen','idChuyen','id');
    }
}
