<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\ve;
use App\chuyen;
use App\lotrinh;
use App\tinhdi;
use App\tinhden;
use App\tuyen;
use App\hang;
use App\xe;
use App\User;

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
        if(isset($request->sort) && $request->sort != -1){
            $ve = ve::where('tinhtrang',$request->sort)
                ->orderBy('created_at','desc')->get();
        }
        elseif (isset($request->search)) {
            $ve = ve::where('id','like','%'.$request->search.'%')
                ->orderBy('created_at','desc')->get();
        }
        else{
            $ve = ve::all();
        }
        return view('admin2.ve.danhsach',['ve'=>$ve,'sort'=>$request->sort]);
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
        $user = User::find($ve->idUser);
        $chuyen = ve::find($id)->chuyenxe;
        $lotrinh = lotrinh::find($chuyen->idLoTrinh);
        $tinhdi = tinhdi::find($lotrinh->idTinhDi);
        $tinhden = tinhden::find($lotrinh->idTinhDen);
        $tuyen = xe::find($lotrinh->idXe)->tuyen;
        $loaixe = xe::find($lotrinh->idXe)->loaixe;
        return view('admin2.ve.chitiet',['ve'=>$ve,'chuyen'=>$chuyen,'lotrinh'=>$lotrinh,'tinhdi'=>$tinhdi,'tinhden'=>$tinhden,'tuyen'=>$tuyen,'user'=>$user,'loaixe'=>$loaixe]);
    }

    public function cancel(Request $request){
        ve::find($request->id)->update(['tinhtrang'=>3]);
        return redirect()->back();
    }

    public function getThongKe(Request $request){
        if(isset($request->date)){
            $vengay = Ve::whereDate('created_at',$request->date)->count();
            $vethang = Ve::whereMonth('created_at',date('m',strtotime($request->date)))->count();
            $chuyenngay = chuyen::whereDate('giodi',$request->date)->count();
            $chuyenthang = chuyen::whereMonth('giodi',date('m',strtotime($request->date)))->count();
        }else{
            $vengay = Ve::whereDate('created_at', '=', Carbon::today()->toDateString())->count();
            $vethang = Ve::whereMonth('created_at',date('m',strtotime(Carbon::today()->toDateString())) )->count();
            $chuyenngay = chuyen::whereDate('giodi', '=', Carbon::today()->toDateString())->count();
            $chuyenthang = chuyen::whereMonth('giodi',strtotime(Carbon::today()->toDateString()))->count();
        }
        return view('admin2.thongke.thongke',['vengay'=>$vengay,'vethang'=>$vethang,'chuyenngay'=>$chuyenngay,'chuyenthang'=>$chuyenthang]);
    }
}
