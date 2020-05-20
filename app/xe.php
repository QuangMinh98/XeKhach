<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ghe;
use App\lotrinh;
use App\chuyen;
use App\ve;

class xe extends Model
{
    protected $table = 'xe';
    protected $fillable = [
        'tenxe',
        'mauxe',
        'sotang',
        'soghe',
        'mota',
        'biensoxe',
        'tinhtrang',
        'img',
        'idtuyen',
        'idHang',
        'idloaixe'
    ];

    public function tuyen(){
    	return $this->belongsTo('App\tuyen','idtuyen','id');
    }

    public function loaixe(){
    	return $this->belongsTo('App\loaixe','idloaixe','id');
    }

    public function hang(){
    	return $this->belongsTo('App\hang','idHang','id');
    }

    public function ghe(){
        return $this->hasMany('App\ghe','idXe','id');
    }

    public static function delXe($id){
        $chuyen = xe::find($id)->hasManyThrough('App\chuyen','App\lotrinh','idXe','idLoTrinh');
        foreach($chuyen as $list){
            chuyen::delChuyen($list->id);
            ve::where('idChuyen',$list->id)->delete();
        }
        ghe::where('idXe',$id)->delete();
        lotrinh::where('idXe',$id)->delete();
        xe::find($id)->delete();
    }
}
