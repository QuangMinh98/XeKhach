<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\ve;
use App\chuyen;
use App\lotrinh;
use App\tinhdi;
use App\tinhden;
use App\tuyen;
use App\hang;
use App\xe;

class veController extends Controller
{
    public function datve(Request $request){
    	if(Auth::check()){
    		$ve = new ve();
    		$ve->soghe =  $request->soghe;
    		$ve->idUser = Auth::user()->id;
    		$ve->idChuyen = $request->idChuyen;
    		$ve->tinhtrang = 0;
    		$ve->thanhtoan = 0;
    		$ve->save();
    		return redirect()->route('demoview');
    	}
    	else{
    		return redirect()->route('login');
    	}
    }

    public function danhsachve(Request $request){
        if(isset($request->status) && $request->status != -1){
            $ve = ve::where('tinhtrang',$request->status)
                ->orderBy('created_at','desc')->get();
        }
        elseif (isset($request->search)) {
            $ve = ve::where('id','like','%'.$request->search.'%')
                ->orderBy('created_at','desc')->get();
        }
        else{
            $ve = ve::all();
        }
        return view('admin.ve.danhsach',['ve'=>$ve]);
    }

    public function thanhtoan(Request $request){
        $ve = ve::find($request->id);
        $ve->thanhtoan = $request->thanhtoan;
        $ve->save();   
    }

    public function tiepnhan(Request $request){
        $ve = ve::find($request->id);
        $ve->tinhtrang = $request->status;
        $ve->save();
    }

    public function showDetail($id){
        $ve = ve::find($id);
        $chuyen = ve::find($id)->chuyenxe;
        $lotrinh = lotrinh::find($chuyen->idLoTrinh);
        $tinhdi = tinhdi::find($lotrinh->idTinhDi);
        $tinhden = tinhden::find($lotrinh->idTinhDen);
        $tuyen = xe::find($lotrinh->idXe)->tuyen;
        $hang = xe::find($lotrinh->idXe)->hang;
        return view('admin.ve.chitiet',['ve'=>$ve,'chuyen'=>$chuyen,'lotrinh'=>$lotrinh,'tinhdi'=>$tinhdi,'tinhden'=>$tinhden,'tuyen'=>$tuyen,'hang'=>$hang]);
    }
}