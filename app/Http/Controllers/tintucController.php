<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\tintuc;

class tintucController extends Controller
{
    public function getDanhSach(Request $request){
    	if(isset($request->search)){
    		$tintuc = tintuc::where('tieude','like','%'.$request->search.'%')->get();
    	}elseif(isset($request->sort)){
    		switch ($request->sort) {
    			case '0':
    				$tintuc = tintuc::orderBy('created_at','desc')->get();
    				break;
    			case '1':
    				$tintuc = tintuc::orderBy('created_at','asc')->get();
    				break;
    			default:
    				$tintuc = tintuc::orderBy('created_at','desc')->get();
    				break;
    		}
    	}else{
    		$tintuc = tintuc::orderBy('created_at','asc')->get();
    	}
    	return view('admin2.tintuc.danhsach',['tintuc'=>$tintuc,'sort'=>$request->sort]);
    }

    public function showAdd(){
    	return view('admin2.tintuc.add');
    }

    public function addTin(Request $request){
    	$this->validate($request,[
    		'tieude' => 'required|max:255',
    		'tomtat' => 'required|max:255',
    		'noidung' => 'required',
    		'upload' => 'required'
    	],[
    		'tieude.required' => 'Bạn chưa nhập tiêu đề',
    		'tieude.max' => 'Tiêu đề có tối đa 255 ký tự',
    		'tomtat.required' => 'Bạn chưa nhập tóm tắt',
    		'tomtat.max' => 'Tóm tắt có tối đa 255 ký tự',
    		'noidung.required' => 'Bạn chưa nhập nội dung',
    		'upload.required' => 'Bạn chưa chọn ảnh'
    	]);
    	$tenkhongdau = strtolower(convert_vi_to_en($request->tieude));
    	$name = Str::random(10);
        $file = $request->file('upload');
        $file->move('img',$name.'.png');
    	tintuc::create([
    		'tieude'=>$request->tieude,
    		'tomtat'=>$request->tomtat,
    		'noidung'=>$request->noidung,
    		'luotxem'=>0,
    		'img' => 'img/'.$name.'.png',
    		'tenkhongdau' => $tenkhongdau
    	]);
    	return redirect()->route('tintuc')->with('thongbao','Đã thêm thành công.');
    }

    public function showEdit($id){
    	$tintuc = tintuc::findOrFail($id);
    	return view('admin2.tintuc.edit',['tintuc'=>$tintuc]);
    }

    public function editTin(Request $request){
    	$this->validate($request,[
    		'tieude' => 'required|max:255',
    		'tomtat' => 'required|max:255',
    		'noidung' => 'required'
    	],[
    		'tieude.required' => 'Bạn chưa nhập tiêu đề',
    		'tieude.max' => 'Tiêu đề có tối đa 255 ký tự',
    		'tomtat.required' => 'Bạn chưa nhập tóm tắt',
    		'tomtat.max' => 'Tóm tắt có tối đa 255 ký tự',
    		'noidung.required' => 'Bạn chưa nhập nội dung'
    	]);
    	$tenkhongdau = strtolower(convert_vi_to_en($request->tieude));
    	if(isset($request->upload)){
            $name = Str::random(10);
            $file = $request->file('upload');
            $file->move('img',$name.'.png');
            tintuc::findOrFail($request->id)->update([
	    		'tieude'=>$request->tieude,
	    		'tomtat'=>$request->tomtat,
	    		'noidung'=>$request->noidung,
	    		'luotxem'=>0,
	    		'img' => 'img/'.$name.'.png',
	    		'tenkhongdau' => $tenkhongdau
	    	]);
        }
    	else{
    		tintuc::findOrFail($request->id)->update([
	    		'tieude'=>$request->tieude,
	    		'tomtat'=>$request->tomtat,
	    		'noidung'=>$request->noidung,
	    		'luotxem'=>0,
	    		'tenkhongdau' => $tenkhongdau
	    	]);
    	}
    	return redirect()->route('tintuc')->with('thongbao','Đã chỉnh sửa thành công.');	
    }

    public function deleteTin(Request $request){
    	tintuc::findOrFail($request->id)->delete();
    	return redirect()->route('tintuc')->with('thongbao','Đã xóa thành công.');
    }
}
