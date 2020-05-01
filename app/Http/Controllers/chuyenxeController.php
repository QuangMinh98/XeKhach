<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\chuyen;
use App\tuyen;
use App\xe;
use App\lotrinh;
use App\hang;
use App\loaixe;
use App\tinhdi;
use App\tinhden;
use App\ve;

class chuyenxeController extends Controller
{
    public function getDanhSach(Request $request){
        $tinh = tinhdi::all();
        if(isset($request->noidi)||isset($request->noiden)||isset($request->ngaydi)){
            $chuyen = chuyen::join('lotrinh','chuyen.idLoTrinh','lotrinh.id')
                    ->join('tinhdi','lotrinh.idTinhDi','tinhdi.id')
                    ->join('tinhden','lotrinh.idTinhDen','tinhden.id')
                    ->join('xe','lotrinh.idXe','xe.id')
                    ->join('hang','xe.idHang','hang.id')
                    ->join('tuyen','xe.idTuyen','tuyen.id')
                    ->where('lotrinh.idTinhDi','=',$request->noidi)
                    ->where('lotrinh.idTinhDen','=',$request->noiden)
                    ->whereDate('chuyen.giodi','=',$request->ngaydi)
                    ->where('chuyen.tinhtrang',0)
                    ->orderBy('chuyen.giodi','desc')
                    ->select('chuyen.id','tuyen.tentuyen','hang.tenhang','xe.tenxe','xe.biensoxe','xe.soghe','tinhdi.tentinh as tentinhdi','tinhden.tentinh as tentinhden','lotrinh.noidi','lotrinh.noiden','chuyen.giodi','chuyen.gioden','chuyen.giave','chuyen.tinhtrang')
                    ->get();
        }
    	elseif(isset($request->search)&&isset($request->sort)){
    		switch ($request->sort) {
    			case 1:
    				$chuyen = chuyen::join('lotrinh','chuyen.idLoTrinh','lotrinh.id')
    				->join('tinhdi','lotrinh.idTinhDi','tinhdi.id')
    				->join('tinhden','lotrinh.idTinhDen','tinhden.id')
    				->join('xe','lotrinh.idXe','xe.id')
    				->join('hang','xe.idHang','hang.id')
    				->join('tuyen','xe.idTuyen','tuyen.id')
    				->where('chuyen.id','=',$request->search)
    				->orderBy('chuyen.giodi','desc')
    				->select('chuyen.id','tuyen.tentuyen','hang.tenhang','xe.tenxe','xe.biensoxe','xe.soghe','tinhdi.tentinh as tentinhdi','tinhden.tentinh as tentinhden','lotrinh.noidi','lotrinh.noiden','chuyen.giodi','chuyen.gioden','chuyen.giave','chuyen.tinhtrang')
    				->get();
    				break;
    			
    			case 2:
    				$chuyen = chuyen::join('lotrinh','chuyen.idLoTrinh','lotrinh.id')
    				->join('tinhdi','lotrinh.idTinhDi','tinhdi.id')
    				->join('tinhden','lotrinh.idTinhDen','tinhden.id')
    				->join('xe','lotrinh.idXe','xe.id')
    				->join('hang','xe.idHang','hang.id')
    				->join('tuyen','xe.idTuyen','tuyen.id')
    				->where('chuyen.id','=',$request->search)
    				->orderBy('chuyen.giodi','asc')
    				->select('chuyen.id','tuyen.tentuyen','hang.tenhang','xe.tenxe','xe.biensoxe','xe.soghe','tinhdi.tentinh as tentinhdi','tinhden.tentinh as tentinhden','lotrinh.noidi','lotrinh.noiden','chuyen.giodi','chuyen.gioden','chuyen.giave','chuyen.tinhtrang')
    				->get();
    				break;
    		}
    	}
    	elseif(isset($request->search)){
    		$chuyen = chuyen::join('lotrinh','chuyen.idLoTrinh','lotrinh.id')
    				->join('tinhdi','lotrinh.idTinhDi','tinhdi.id')
    				->join('tinhden','lotrinh.idTinhDen','tinhden.id')
    				->join('xe','lotrinh.idXe','xe.id')
    				->join('hang','xe.idHang','hang.id')
    				->join('tuyen','xe.idTuyen','tuyen.id')
    				->where('chuyen.id','=',$request->search)
    				->select('chuyen.id','tuyen.tentuyen','hang.tenhang','xe.tenxe','xe.biensoxe','xe.soghe','tinhdi.tentinh as tentinhdi','tinhden.tentinh as tentinhden','lotrinh.noidi','lotrinh.noiden','chuyen.giodi','chuyen.gioden','chuyen.giave','chuyen.tinhtrang')
    				->get();
    	}
    	elseif(isset($request->sort)){
    		switch ($request->sort) {
    			case 1:
    				$chuyen = chuyen::join('lotrinh','chuyen.idLoTrinh','lotrinh.id')
    				->join('tinhdi','lotrinh.idTinhDi','tinhdi.id')
    				->join('tinhden','lotrinh.idTinhDen','tinhden.id')
    				->join('xe','lotrinh.idXe','xe.id')
    				->join('hang','xe.idHang','hang.id')
    				->join('tuyen','xe.idTuyen','tuyen.id')
    				->orderBy('chuyen.giodi','desc')
    				->select('chuyen.id','tuyen.tentuyen','hang.tenhang','xe.tenxe','xe.biensoxe','xe.soghe','tinhdi.tentinh as tentinhdi','tinhden.tentinh as tentinhden','lotrinh.noidi','lotrinh.noiden','chuyen.giodi','chuyen.gioden','chuyen.giave','chuyen.tinhtrang')
    				->get();
    				break;
    			
    			case 2:
    				$chuyen = chuyen::join('lotrinh','chuyen.idLoTrinh','lotrinh.id')
    				->join('tinhdi','lotrinh.idTinhDi','tinhdi.id')
    				->join('tinhden','lotrinh.idTinhDen','tinhden.id')
    				->join('xe','lotrinh.idXe','xe.id')
    				->join('hang','xe.idHang','hang.id')
    				->join('tuyen','xe.idTuyen','tuyen.id')
    				->orderBy('chuyen.giodi','asc')
    				->select('chuyen.id','tuyen.tentuyen','hang.tenhang','xe.tenxe','xe.biensoxe','xe.soghe','tinhdi.tentinh as tentinhdi','tinhden.tentinh as tentinhden','lotrinh.noidi','lotrinh.noiden','chuyen.giodi','chuyen.gioden','chuyen.giave','chuyen.tinhtrang')
    				->get();
    				break;
    			}
    		}
    		else{
    			$chuyen = chuyen::join('lotrinh','chuyen.idLoTrinh','lotrinh.id')
    				->join('tinhdi','lotrinh.idTinhDi','tinhdi.id')
    				->join('tinhden','lotrinh.idTinhDen','tinhden.id')
    				->join('xe','lotrinh.idXe','xe.id')
    				->join('hang','xe.idHang','hang.id')
    				->join('tuyen','xe.idTuyen','tuyen.id')
    				->orderBy('chuyen.giodi','desc')
    				->select('chuyen.id','tuyen.tentuyen','hang.tenhang','xe.tenxe','xe.biensoxe','xe.soghe','tinhdi.tentinh as tentinhdi','tinhden.tentinh as tentinhden','lotrinh.noidi','lotrinh.noiden','chuyen.giodi','chuyen.gioden','chuyen.giave','chuyen.tinhtrang')
    				->get();
    		}
    	return view('teamplate.chuyenxe.danhsach',['chuyen'=>$chuyen,'sort'=>$request->sort,'tinh'=>$tinh]);
    }

    public function showAdd(){
    	$hangxe = hang::all();
    	$tuyen = tuyen::all();
    	$loaixe = loaixe::all();
    	$xe = xe::all();
    	return view('teamplate.chuyenxe.add',['hangxe'=>$hangxe,'tuyen'=>$tuyen,'loaixe'=>$loaixe,'xe'=>$xe]);
    }

    public function ajaxXe(Request $request){
    	$xe = xe::where('idHang','=',$request->idHang)
    		->where('idTuyen','=',$request->idTuyen)
    		->where('idLoaiXe','=',$request->idLoaiXe)
    		->get();
    	return view('admin.chuyenxe.ajax',['xe'=>$xe]);
    }

    public function ajaxLoTrinh(Request $request){
    	$lotrinh = lotrinh::join('tinhdi','lotrinh.idTinhDi','=','tinhdi.id')
    			->join('tinhden','lotrinh.idTinhDen','=','tinhden.id')
    			->where('lotrinh.idXe','=',$request->idXe)
    			->select('lotrinh.id','lotrinh.noidi','lotrinh.noiden','tinhdi.tentinh as tentinhdi','tinhden.tentinh as tentinhden')
    			->get();
    	return view('admin.chuyenxe.ajax',['lotrinh'=>$lotrinh]);
    }

    public function addChuyen(Request $request){
    	$this->validate($request,[
    		'idlotrinh' => 'required',
    		'giave'=>'required|min:0'
    	]);
    	$chuyen = new chuyen;
    	$chuyen->idLoTrinh = $request->idlotrinh;
    	$chuyen->giodi = $request->ngaydi;
    	$chuyen->gioden=$request->ngayden;
    	$chuyen->giave = $request->giave;
        $chuyen->tinhtrang = 0;
    	$chuyen->save();
    	return redirect()->route('chuyenxe')->with('thongbao','Đã thêm thành công.');
    }

    public function showEdit($id){
        $hang = hang::all();
        $tuyen = tuyen::all();
        $loaixe = loaixe::all();
        $xe = xe::all();
        $chuyen = chuyen::join('lotrinh','chuyen.idLoTrinh','lotrinh.id')
                    ->join('xe','lotrinh.idXe','xe.id')
                    ->join('hang','xe.idHang','hang.id')
                    ->join('tuyen','xe.idTuyen','tuyen.id')
                    ->join('loaixe','xe.idLoaiXe','loaixe.id')
                    ->where('chuyen.id',$id)
                    ->select('chuyen.id','chuyen.idLoTrinh','xe.id as idXe','tuyen.id as idTuyen','hang.id as idHang','loaixe.id as idLoaiXe','chuyen.giodi','chuyen.gioden','chuyen.giave')
                    ->first();
        $lotrinh = lotrinh::join('tinhdi','lotrinh.idTinhDi','tinhdi.id')
                ->join('tinhden','lotrinh.idTinhDen','tinhden.id')
                ->where('idXe',$chuyen->idXe)
                ->select('lotrinh.id','tinhdi.tentinh as tentinhdi','tinhden.tentinh as tentinhden','lotrinh.noidi','lotrinh.noiden')
                ->get();
        return view('teamplate.chuyenxe.edit',['hangxe'=>$hang,'tuyen'=>$tuyen,'loaixe'=>$loaixe,'xe'=>$xe,'chuyen'=>$chuyen,'lotrinh'=>$lotrinh]);
    }

    public function editChuyen(Request $request){
        $this->validate($request,[
            'idlotrinh' => 'required',
            'giave'=>'required|min:0'
        ]);
        $chuyen = chuyen::findOrFail($request->id);
        $chuyen->idLoTrinh = $request->idlotrinh;
        $chuyen->giodi = $request->ngaydi;
        $chuyen->gioden=$request->ngayden;
        $chuyen->giave = $request->giave;
        $chuyen->save();
        return redirect()->route('chuyenxe')->with('thongbao','Đã thêm thành công.');
    }

    public function showDetail($id){
        $chuyen = chuyen::join('lotrinh','chuyen.idLoTrinh','lotrinh.id')
        ->join('tinhdi','lotrinh.idTinhDi','tinhdi.id')
        ->join('tinhden','lotrinh.idTinhDen','tinhden.id')
        ->join('xe','lotrinh.idXe','xe.id')
        ->join('hang','xe.idHang','hang.id')
        ->join('tuyen','xe.idTuyen','tuyen.id')
        ->join('loaixe','xe.idLoaiXe','loaixe.id')
        ->where('chuyen.id',$id)
        ->select('chuyen.id','chuyen.idLoTrinh','xe.id as idXe','lotrinh.noidi','lotrinh.noiden','tinhdi.tentinh as tentinhdi','tinhden.tentinh as tentinhden','tuyen.tentuyen','hang.tenhang','hang.img','loaixe.tenloaixe','chuyen.giodi','chuyen.gioden','chuyen.giave','chuyen.tinhtrang')
        ->firstOrFail();
        $xe = xe::findOrFail($chuyen->idXe);
        $ghe = xe::findOrFail($chuyen->idXe)->ghe; 
        $sove = ve::where('idChuyen',$chuyen->id)->count();
        $ve = ve::where('idChuyen',$chuyen->id)->where('tinhtrang','!=','3')->get();
        $arrayVe = array();
        foreach($ve as $ticket){
            $arrayVe[] = $ticket->soghe;
        }
        return view('teamplate.chuyenxe.chitiet',['chuyen'=>$chuyen,'sove'=>$sove,'xe'=>$xe,'ghe'=>$ghe,'ve'=>$arrayVe]);
    }

    public function changeStatus(Request $request){
        $chuyen = chuyen::findOrFail($request->id);
        $chuyen->tinhtrang = $request->status;
        $chuyen->save();
        if($request->status == 2){
            $ve = ve::where('idChuyen',$request->id)->where('tinhtrang','1')->update(['tinhtrang'=>'2']);
        }
        else{
            $ve = ve::where('idChuyen',$request->id)->where('tinhtrang','2')->update(['tinhtrang'=>'1']);
        }
    }

    public function deleteChuyen(Request $request){
        $chuyen = chuyen::delChuyen($request->id);
        return redirect()->route('chuyenxe')->with('thongbao','Đã xóa thành công');
    }

    public function demoSearch(Request $request){
        $tinh = tinhdi::all();
        if(isset($request->noidi)||isset($request->noiden)||isset($request->ngaydi)){
            $chuyen = chuyen::join('lotrinh','chuyen.idLoTrinh','lotrinh.id')
                    ->join('tinhdi','lotrinh.idTinhDi','tinhdi.id')
                    ->join('tinhden','lotrinh.idTinhDen','tinhden.id')
                    ->join('xe','lotrinh.idXe','xe.id')
                    ->join('hang','xe.idHang','hang.id')
                    ->join('tuyen','xe.idTuyen','tuyen.id')
                    ->where('lotrinh.idTinhDi','=',$request->noidi)
                    ->where('lotrinh.idTinhDen','=',$request->noiden)
                    ->whereDate('chuyen.giodi','=',$request->ngaydi)
                    ->orderBy('chuyen.giodi','desc')
                    ->select('chuyen.id','tuyen.tentuyen','hang.tenhang','xe.tenxe','xe.biensoxe','xe.soghe','tinhdi.tentinh as tentinhdi','tinhden.tentinh as tentinhden','lotrinh.noidi','lotrinh.noiden','chuyen.giodi','chuyen.gioden','chuyen.giave','chuyen.tinhtrang')
                    ->get();
        }
        return view('user.demoview',['tinh'=>$tinh,'chuyen'=>$chuyen]);
    }

    public function demochitiet($id){
        $chuyen = chuyen::join('lotrinh','chuyen.idLoTrinh','lotrinh.id')
        ->join('tinhdi','lotrinh.idTinhDi','tinhdi.id')
        ->join('tinhden','lotrinh.idTinhDen','tinhden.id')
        ->join('xe','lotrinh.idXe','xe.id')
        ->join('hang','xe.idHang','hang.id')
        ->join('tuyen','xe.idTuyen','tuyen.id')
        ->join('loaixe','xe.idLoaiXe','loaixe.id')
        ->where('chuyen.id',$id)
        ->select('chuyen.id','chuyen.idLoTrinh','xe.id as idXe','lotrinh.noidi','lotrinh.noiden','tinhdi.tentinh as tentinhdi','tinhden.tentinh as tentinhden','tuyen.tentuyen','hang.tenhang','hang.img','loaixe.tenloaixe','chuyen.giodi','chuyen.gioden','chuyen.giave','chuyen.tinhtrang')
        ->firstOrFail();
        $xe = xe::findOrFail($chuyen->idXe);
        $ghe = xe::findOrFail($chuyen->idXe)->ghe; 
        $sove = ve::where('idChuyen',$chuyen->id)->count();
        $ve = ve::where('idChuyen',$chuyen->id)->where('tinhtrang','!=','3')->get();
        $arrayVe = array();
        foreach($ve as $ticket){
            $arrayVe[] = $ticket->soghe;
        }
        return view('user.demochitiet',['chuyen'=>$chuyen,'sove'=>$sove,'xe'=>$xe,'ghe'=>$ghe,'ve'=>$arrayVe]);
    }
}
