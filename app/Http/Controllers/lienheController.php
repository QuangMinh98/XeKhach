<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lienhe;
use App\maps;

class lienheController extends Controller
{
    public function getDanhSach(Request $request){
    	if(isset($request->search)){
    		$lienhe = lienhe::where('lienhe','like','%'.$request->lienhe.'%')->get();
    	}
    	else{
    		$lienhe = lienhe::all();
    	}
        $maps = maps::first();
    	return view('admin2.lienhe.danhsach',['lienhe'=>$lienhe,'maps'=>$maps]);
    }

    public function addLienHe(Request $request){
    	$this->validate($request,[
    		'lienhe' => 'required',
    		'thongtin' => 'required'
    	],[
    		'lienhe.required' => 'Bạn chưa nhập loại liên hệ',
    		'thongtin.required' => 'Bạn chưa nhập thông tin liên hệ'
    	]);
    	lienhe::create($request->all());
    	return redirect()->route('lienhe')->with('thongbao','Đã thêm thành công.');
    }

    public function editLienHe(Request $request){
    	$this->validate($request,[
    		'lienhe' => 'required',
    		'thongtin' => 'required'
    	],[
    		'lienhe.required' => 'Bạn chưa nhập loại liên hệ',
    		'thongtin.required' => 'Bạn chưa nhập thông tin liên hệ'
    	]);
    	lienhe::findOrFail($request->id)->update($request->all());
    	return redirect()->route('lienhe')->with('thongbao','Đã chỉnh sửa thành công.');
    }

    public function deleteLienHe(Request $request){
    	lienhe::findOrFail($request->id)->delete();
    }

    public function maps(Request $request){
        $maps = maps::all();
        if(isset($map)){
            maps::update($request->all());
        }else{
            maps::create($request->all());
        }
        return redirect()->route('lienhe')->with('thongbao','Đã chỉnh sửa thành công.');
    }
}
