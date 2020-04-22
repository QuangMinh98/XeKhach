<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chuyen extends Model
{
    protected $table = 'chuyen';

    public function tinhdi(){
    	return $this->belongsTo('App\tinhdi','idTinhDi','id');
    }

    public function tinhden(){
    	return $this->belongsTo('App\tinhden','idTinhDen','id');
    }

    public function lotrinh(){
    	return $this->belongsTo('App\lotrinh','idLoTrinh','id');
    }

    public static function delChuyen($id){
        chuyen::find($id)->hasMany('App\ve','idChuyen','id')->delete();
        chuyen::find($id)->delete();
    }

}
