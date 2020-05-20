<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\thongtin;

class thongtinController extends Controller
{
    public function getDanhSach(Request $request){
    	if(isset($request->search)){
    		$thongtin = thongtin::where('tieude','like','%'.$request->search.'%')->get();
    	}
    	else{
    		$thongtin = thongtin::all();
    	}
    	return view('admin1.thongtin.danhsach',['thongtin'=>$thongtin]);
    }

    public function showAdd(Request $request){
    	return view('admin1.thongtin.add');
    }

    public function addThongTin(Request $request){
    	$this->validate($request,[
    		'tieude' => 'required|max:255',
    		'noidung' => 'required'
    	],[
    		'tieude.required' => 'Bạn chưa nhập tiêu đề',
    		'tieude.max' => 'Tiêu đề có tối đa 255 ký tự',
    		'noidung.required' => 'Bạn chưa nhập nội dung'
    	]);
    	$tenkhongdau = strtolower(convert_vi_to_en($request->tieude));
    	thongtin::create([
    		'tieude'=>$request->tieude,
    		'tenkhongdau'=>$tenkhongdau,
    		'noidung'=>$request->noidung,
    		'gioithieu'=>0
    	]);
    	return redirect()->route('thongtin')->with('thongbao','Đã thêm thành công.');
    }

    public function showEdit($id){
    	$thongtin  = thongtin::findOrFail($id);
    	return view('admin1.thongtin.edit',['thongtin'=>$thongtin]);
    }

    public function editThongTin(Request $request){
    	$this->validate($request,[
    		'tieude' => 'required|max:255',
    		'noidung' => 'required'
    	],[
    		'tieude.required' => 'Bạn chưa nhập tiêu đề',
    		'tieude.max' => 'Tiêu đề có tối đa 255 ký tự',
    		'noidung.required' => 'Bạn chưa nhập nội dung'
    	]);
    	$tenkhongdau = strtolower(convert_vi_to_en($request->tieude));
    	thongtin::findOrFail($request->id)->update([
    		'tieude'=>$request->tieude,
    		'tenkhongdau'=>$tenkhongdau,
    		'noidung'=>$request->noidung
    	]);
    	return redirect()->route('thongtin')->with('thongbao','Đã chỉnh sửa thành công.');
    }

    public function deleteThongTin(Request $request){
    	thongtin::findOrFail($request->id)->delete();
    }

    public function changeGioiThieu(Request $request){
    	thongtin::findOrFail($request->id)->update(['gioithieu'=>$request->gioithieu]);
    }
}
