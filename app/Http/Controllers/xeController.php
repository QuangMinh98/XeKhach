<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\xe;
use App\hang;
use App\tuyen;
use App\loaixe;
use App\tinhdi;
use App\tinhden;
use App\lotrinh;
use App\ghe;

class xeController extends Controller
{
    public function getDanhSach(Request $request){
        $hang = hang::all();
    	if(isset($request->search)&&isset($request->sort)){
            $xe = xe::join('loaixe','xe.idLoaiXe','=','loaixe.id')
                ->join('hang','xe.idHang','=','hang.id')
                ->join('tuyen','xe.idTuyen','=','tuyen.id')
                ->where('tenxe','like','%'.$request->search.'%')
                ->where('xe.idHang',$request->sort)
                ->orderBy('tenxe','asc')
                ->select('xe.id as idXe','tenhang','tenxe','tentuyen','xe.tinhtrang','sotang','soghe','biensoxe')
                ->get();
        }
        elseif(isset($request->sort)){
            $xe = xe::join('loaixe','xe.idLoaiXe','=','loaixe.id')
                ->join('hang','xe.idHang','=','hang.id')
                ->join('tuyen','xe.idTuyen','=','tuyen.id')
                ->where('xe.idHang',$request->sort)
                ->orderBy('tenxe','asc')
                ->select('xe.id as idXe','tenhang','tenxe','tentuyen','xe.tinhtrang','sotang','soghe','biensoxe')
                ->get();
        }
        elseif (isset($request->search)) {
            $xe = xe::join('loaixe','xe.idLoaiXe','=','loaixe.id')
                ->join('hang','xe.idHang','=','hang.id')
                ->join('tuyen','xe.idTuyen','=','tuyen.id')
                ->where('tenxe','like','%'.$request->search.'%')
                ->select('xe.id as idXe','tenhang','tenxe','tentuyen','xe.tinhtrang','sotang','soghe','biensoxe')
                ->get();
        }
        else{
            $xe = xe::join('loaixe','xe.idLoaiXe','=','loaixe.id')
                ->join('hang','xe.idHang','=','hang.id')
                ->join('tuyen','xe.idTuyen','=','tuyen.id')
                ->select('xe.id as idXe','tenhang','tenxe','tentuyen','xe.tinhtrang','sotang','soghe','biensoxe')
                ->get();
        }
    	return view('admin2.xe.danhsach',['xe'=>$xe,'sort'=>$request->sort,'hang'=>$hang]);
    }

    public function showAdd(){
    	//$hang = hang::all();
    	$tuyen = tuyen::all();
    	$loaixe = loaixe::all();
        $tinh = tinhdi::all();
    	return view('admin2.xe.add',[/*'hangxe'=>$hang,*/'tuyen'=>$tuyen,'loaixe'=>$loaixe,'tinh'=>$tinh]);
    }

    public function addXe(Request $request){
        $this->validate($request,[
            'name' => 'required|min:5|max:255',
            'mauxe' => 'required',
            'bienso' => 'required',
            'upload' => 'required',
            'sotang' => 'required|max:4|min:1',
            'soghe' => 'required',
            'noidi' => 'required',
            'noiden' => 'required',
            'mota' => 'required'
        ]);
        $xe = new xe;
        $xe->idtuyen = $request->idtuyen;
        $xe->idHang = 1;
        $xe->idloaixe = $request->idloaixe;
        $xe->tenxe = $request->name;
        $xe->mauxe = $request->mauxe;
        $xe->biensoxe = $request->bienso;
        $xe->sotang = $request->sotang;
        $xe->soghe = $request->soghe;
        $xe->tinhtrang = 'Hoạt Động';
        $xe->mota = $request->mota;
        $name = Str::random(10);
        $file = $request->file('upload');
        $file->move('img',$name.'.png');
        $xe->img = 'img/'.$name.'.png';
        $xe->save();
        for($i = 1 ; $i <= $xe->soghe ; $i++){
            $ghe = new ghe;
            $ghe->soghe = $i;
            $ghe->sotang = 1;
            $ghe->idXe = $xe->id;
            $ghe->save();
        }
        $lotrinhdi = new lotrinh;
        $lotrinhdi->noidi = $request->noidi;
        $lotrinhdi->noiden = $request->noiden;
        $lotrinhdi->khoangcach = $request->khoangcach;
        $lotrinhdi->idTinhDi = $request->tinhdi;
        $lotrinhdi->idTinhDen = $request->tinhden;
        $lotrinhdi->idXe = $xe->id;
        $lotrinhdi->save();
        $lotrinhden = new lotrinh;
        $lotrinhden->noiden = $request->noidi;
        $lotrinhden->noidi = $request->noiden;
        $lotrinhden->khoangcach = $request->khoangcach;
        $lotrinhden->idTinhDen = $request->tinhdi;
        $lotrinhden->idTinhDi = $request->tinhden;
        $lotrinhden->idXe = $xe->id;
        $lotrinhden->save();
        return redirect()->route('xe')->with('thongbao','Đã thêm thành công.');
    }

    public function showDetail($id){
        $xe = xe::findOrFail($id);
        $tuyen = xe::find($id)->tuyen;
        $hang = xe::find($id)->hang;
        $loaixe = xe::find($id)->loaixe;
        $ghe = xe::find($id)->ghe;
        $lotrinh = xe::join('lotrinh','xe.id','=','lotrinh.idXe')
                ->join('tinhdi','lotrinh.idTinhDi','=','tinhdi.id')
                ->join('tinhden','lotrinh.idTinhDen','=','tinhden.id')
                ->select('lotrinh.id','tinhdi.tentinh as tentinhdi','noidi','tinhden.tentinh as tentinhden','noiden')
                ->orderBy('id','asc')
                ->first();
        return view('admin2.xe.chitiet',['xe'=>$xe,'tuyen'=>$tuyen,'hang'=>$hang,'loaixe'=>$loaixe,'lotrinh'=>$lotrinh,'ghe'=>$ghe]);
    }

    public function editSeat(Request $request){
        $ghe = ghe::where('idXe','=',$request->id)
        ->whereBetween('soghe',[$request->from,$request->to])
        ->update(['sotang'=>$request->tang]);
        if(isset($ghe)){
            echo "Cập nhật thành công.";
        }
        else{
            echo "Cập nhật thất bại.";
        }
    }

    public function showEdit($id){
        $xe = xe::find($id);
        $lotrinhdi = lotrinh::where('idXe',$id)->first();
        $lotrinhve = lotrinh::where('idXe',$id)->orderBy('id','desc')->first();
        //$hang = hang::all();
        $loaixe = loaixe::all();
        $tuyen = tuyen::all();
        $tinhdi = tinhdi::all();
        return view('admin2.xe.edit',['xe'=>$xe,/*'hangxe'=>$hang,*/'loaixe'=>$loaixe,'tuyen'=>$tuyen,'tinh'=>$tinhdi,'lotrinhdi'=>$lotrinhdi,'lotrinhve'=>$lotrinhve]);
    }

    public function editXe(Request $request){
        $this->validate($request,[
            'idtuyen' => 'required',
            'idloaixe' => 'required',
            'name' => 'required|min:5|max:255',
            'mauxe' => 'required',
            'bienso' => 'required',
            'sotang' => 'required|max:4|min:1',
            'soghe' => 'required',
            'noidi' => 'required',
            'noiden' => 'required',
            'mota' => 'required'
        ]);
        $xe = xe::find($request->id);
        $xe->idtuyen = $request->idtuyen;
        $xe->idloaixe = $request->idloaixe;
        $xe->tenxe = $request->name;
        $xe->mauxe = $request->mauxe;
        $xe->biensoxe = $request->bienso;
        $xe->sotang = $request->sotang;
        if($request->soghe > $xe->soghe){
            for($i=$xe->soghe+1 ; $i<=$request->soghe ;$i++){
                $ghe = new ghe;
                $ghe->idXe = $request->id;
                $ghe->soghe = $i;
                $ghe->sotang = 1;
                $ghe->save();
            }
        }
        if($request->soghe < $xe->soghe){
            $ghe = ghe::where('idXe','=',$request->id)
            ->whereBetween('soghe',[$request->soghe+1,$xe->soghe])
            ->delete();
        }
        $xe->soghe = $request->soghe;
        $xe->tinhtrang = 'Hoạt Động';
        $xe->mota = $request->mota;
        if(isset($request->upload))
        {
            $name = Str::random(10);
            $file = $request->file('upload');
            $file->move('img',$name.'.png');
            $xe->img = 'img/'.$name.'.png';
        }
        $xe->save();
        $lotrinhdi = lotrinh::find($request->lotrinhdi);
        $lotrinhdi->noidi = $request->noidi;
        $lotrinhdi->noiden = $request->noiden;
        $lotrinhdi->khoangcach = $request->khoangcach;
        $lotrinhdi->idTinhDi = $request->tinhdi;
        $lotrinhdi->idTinhDen = $request->tinhden;
        $lotrinhdi->save();
        $lotrinhden = lotrinh::find($request->lotrinhve);
        $lotrinhden->noiden = $request->noidi;
        $lotrinhden->noidi = $request->noiden;
        $lotrinhden->khoangcach = $request->khoangcach;
        $lotrinhden->idTinhDen = $request->tinhdi;
        $lotrinhden->idTinhDi = $request->tinhden;
        $lotrinhden->save();

        return redirect()->route('xe')->with('thongbao','Đã chỉnh sửa thành công.');
    }

    public function delXe(Request $request){
        xe::delXe($request->id);
    }

    public function changeStatus(Request $request){
        xe::find($request->id)->update(['tinhtrang'=>$request->status]);
    }
}
