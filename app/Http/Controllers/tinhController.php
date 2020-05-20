<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tinhdi;
use App\tinhden;

class tinhController extends Controller
{
    public function getDanhSach(Request $request){
    	if(isset($request->search)&&isset($request->sort)){
            switch($request->sort){
                case 1: $tinh = tinhdi::where('tentinh','like','%'.$request->search.'%')->orderBy('tentinh','asc')->get();
                break;
                case 2: $tinh = tinhdi::where('tentinh','like','%'.$request->search.'%')->orderBy('tentinh','desc')->get();
            }
        }
        elseif(isset($request->sort)){
            switch($request->sort){
                case 1: $tinh = tinhdi::orderBy('tentinh','asc')->get();
                break;
                case 2: $tinh = tinhdi::orderBy('tentinh','desc')->get();
                break;
                case 3: $tinh = tinhdi::orderBy('created_at','asc')->get();
                break;
                case 4: $tinh = tinhdi::orderBy('created_at','desc')->get();
            }
        }
        elseif (isset($request->search)) {
            $tinh = tinhdi::where('tentinh','like','%'.$request->search.'%')->get();
        }
        else{
            $tinh = tinhdi::orderBy('tentinh','asc')->get();
        }
    	return view('admin1.tinh.danhsach',['tinh'=>$tinh,'sort'=>$request->sort]);
    }

    public function addTinh(Request $request){
        $this->validate($request,[
            'name' => 'required|min:3|max:255'
        ],[
            'name.required' => 'Bạn chưa nhập tên tỉnh thành.',
            'name.min' => 'Tên tỉnh thành cần chứa ít nhất 3 ký tự.',
            'name.max' => 'Tên tỉnh thành có tối đa 255 ký tự'
        ]);
        tinhdi::create(['tentinh'=>$request->name]);
        tinhden::create(['tentinh'=>$request->name]);
        return redirect()->route('tinh')->with('thongbao','Đã thêm thành công.');
    }

    public function editTinh(Request $request){
        $this->validate($request,[
            'name' => 'required|min:3|max:255'
        ],[
            'name.required' => 'Bạn chưa nhập tên tỉnh thành.',
            'name.min' => 'Tên tỉnh thành cần chứa ít nhất 3 ký tự.',
            'name.max' => 'Tên tỉnh thành có tối đa 255 ký tự'
        ]);
        tinhdi::find($request->id)->update(['tentinh'=>$request->name]);
        tinhden::find($request->id)->update(['tentinh'=>$request->name]);
        return redirect()->route('tinh')->with('thongbao','Đã chỉnh sửa thành công.');
    }

}
