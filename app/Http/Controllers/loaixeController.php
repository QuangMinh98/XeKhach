<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\loaixe;

class loaixeController extends Controller
{
    public function getDanhSach(Request $request){
		if(isset($request->search)&&isset($request->sort)){
            switch($request->sort){
                case 1: $loaixe = loaixe::where('tenloaixe','like','%'.$request->search.'%')->orderBy('tenloaixe','asc')->get();
                break;
                case 2: $loaixe = loaixe::where('tenloaixe','like','%'.$request->search.'%')->orderBy('tenloaixe','desc')->get();
                break;
                case 3: $loaixe = loaixe::where('tenloaixe','like','%'.$request->search.'%')->orderBy('created_at','desc')->get();
                break;
                case 4: $loaixe = loaixe::where('tenloaixe','like','%'.$request->search.'%')->orderBy('created_at','asc')->get();
            }
        }
        elseif(isset($request->sort)){
            switch($request->sort){
                case 1: $loaixe = loaixe::orderBy('tenloaixe','asc')->get();
                break;
                case 2: $loaixe = loaixe::orderBy('tenloaixe','desc')->get();
                break;
                case 3: $loaixe = loaixe::orderBy('created_at','asc')->get();
                break;
                case 4: $loaixe = loaixe::orderBy('created_at','desc')->get();
            }
        }
        elseif (isset($request->search)) {
            $loaixe = loaixe::where('tenloaixe','like','%'.$request->search.'%')->get();
        }
        else{
            $loaixe = loaixe::all();
        }
    	return view('teamplate.loaixe.danhsach',['loaixe'=>$loaixe,'sort'=>$request->sort]);
    }

    public function addLoaiXe(Request $request){
    	$this->validate($request,[
    		'name' => 'required|min:3|max:255'
    	],[
    		'name.required' => 'Bạn chưa nhập vào tên loại xe',
    		'name.min' => 'Tên cần chứa ít nhất 3 ký tự',
    		'name.max' => 'Tên có tối đa 255 ký tự'
    	]);
    	loaixe::create(['tenloaixe'=>$request->name]);
    	return redirect()->route('loaixe')->with('thongbao','Đã thêm thành công.');
    }

    public function editLoaiXe(Request $request){
    	$this->validate($request,[
    		'name' => 'required|min:3|max:255'
    	],[
    		'name.required' => 'Bạn chưa nhập vào tên loại xe',
    		'name.min' => 'Tên cần chứa ít nhất 3 ký tự',
    		'name.max' => 'Tên có tối đa 255 ký tự'
    	]);
    	loaixe::find($request->id)->update(['tenloaixe'=>$request->name]);
    	return redirect()->route('loaixe')->with('thongbao','Đã chỉnh sửa thành công');
    }

    public function deleteLoaiXe(Request $request){
    	loaixe::destroy($request->id);
    	return redirect()->route('loaixe')->with('thongbao','Đã xóa thành công');
    }
}
