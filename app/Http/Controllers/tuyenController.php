<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\tuyen;

class tuyenController extends Controller
{
    public function getDanhSach(Request $request){
        if(isset($request->search)&&isset($request->sort)){
            switch($request->sort){
                case 1: $tuyen = tuyen::where('tentuyen','like','%'.$request->search.'%')->orderBy('tentuyen','asc')->get();
                break;
                case 2: $tuyen = tuyen::where('tentuyen','like','%'.$request->search.'%')->orderBy('tentuyen','desc')->get();
                break;
                case 3: $tuyen = tuyen::where('tentuyen','like','%'.$request->search.'%')->orderBy('created_at','desc')->get();
                break;
                case 4: $tuyen = tuyen::where('tentuyen','like','%'.$request->search.'%')->orderBy('created_at','asc')->get();
            }
        }
        elseif(isset($request->sort)){
            switch($request->sort){
                case 1: $tuyen = tuyen::orderBy('tentuyen','asc')->get();
                break;
                case 2: $tuyen = tuyen::orderBy('tentuyen','desc')->get();
                break;
                case 3: $tuyen = tuyen::orderBy('created_at','asc')->get();
                break;
                case 4: $tuyen = tuyen::orderBy('created_at','desc')->get();
            }
        }
        elseif (isset($request->search)) {
            $tuyen = tuyen::where('tentuyen','like','%'.$request->search.'%')->get();
        }
        else{
            $tuyen = tuyen::all();
        }
    	return view('teamplate.tuyen.danhsach',['tuyen'=>$tuyen,'sort'=>$request->sort]);
    }

    public function addTuyen(Request $request){
    	$this->validate($request,[
    		'name' => 'required|min:3|max:255'
    	],[
    		'name.required' => 'Bạn chưa nhập tên tuyến xe',
    		'min' => 'Tên tuyến xe cần tối thiểu 3 ký tự',
    		'max' => 'Tên tuyến xe có tối đa 255 ký tự'
    	]);
    	$tuyen = tuyen::create(['tentuyen'=>$request->name,'tinhtrang'=>$request->status]);
    	return redirect()->route('tuyen')->with('thongbao','Thêm Thành Công');
    }

    public function changeStatus(Request $request){
        tuyen::find($request->id)->update(['tinhtrang'=>$request->status]);
    }

    public function editTuyen(Request $request){
    	$this->validate($request,[
    		'name' => 'required|min:3|max:255'
    	],[
    		'name.required' => 'Bạn chưa nhập tên tuyến xe',
    		'min' => 'Tên tuyến xe cần tối thiểu 3 ký tự',
    		'max' => 'Tên tuyến xe có tối đa 255 ký tự'
    	]);
    	tuyen::find($request->id)->update(['tentuyen'=>$request->name]);
    	return redirect()->route('tuyen')->with('thongbao','Chỉnh sửa thành công');
    }

    public function deleteTuyen(Request $request){
        tuyen::delTuyen($request->id);
    }
}
