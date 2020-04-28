<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\xe;

class hang extends Model
{
    protected $table = "hang";

    public static function del($id){
    	$xe = xe::where('idHang',$id)->get();
    	foreach($xe as $list){
    		xe::del($list->id);
    	}
    	$hang = hang::find($id)->delete();
    }
}
