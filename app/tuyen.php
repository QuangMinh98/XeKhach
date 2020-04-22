<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\xe;

class tuyen extends Model
{
    protected $table = "tuyen";
    protected $fillable = ['tentuyen','tinhtrang'];

    public static function delTuyen($id){
    	$xe = tuyen::find($id)->hasMany('App\xe','idTuyen','id');
    	foreach($xe as $list){
    		xe::delXe($list->id);
    	}
    	tuyen::find($id)->delete();
    }
}
