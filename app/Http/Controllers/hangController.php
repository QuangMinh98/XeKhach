<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\hang;

class hangController extends Controller
{
    public function getDanhSach(Request $request){
        if(isset($request->search)&&isset($request->sort)){
            switch($request->sort){
                case 1: $hang = hang::where('tenhang','like','%'.$request->search.'%')->orderBy('tenhang','asc')->get();
                break;
                case 2: $hang = hang::where('tenhang','like','%'.$request->search.'%')->orderBy('tenhang','desc')->get();
                break;
                case 3: $hang = hang::where('tenhang','like','%'.$request->search.'%')->orderBy('created_at','desc')->get();
                break;
                case 4: $hang = hang::where('tenhang','like','%'.$request->search.'%')->orderBy('created_at','asc')->get();
            }
        }
        elseif(isset($request->sort)){
            switch($request->sort){
                case 1: $hang = hang::orderBy('tenhang','asc')->get();
                break;
                case 2: $hang = hang::orderBy('tenhang','desc')->get();
                break;
                case 3: $hang = hang::orderBy('created_at','asc')->get();
                break;
                case 4: $hang = hang::orderBy('created_at','desc')->get();
            }
        }
        elseif (isset($request->search)) {
            $hang = hang::where('tenhang','like','%'.$request->search.'%')->get();
        }
        else{
            $hang = hang::all();
        }
    	return view('admin.hang.danhsach',['hang'=>$hang,'sort'=>$request->sort]);
    }

    public function showAdd(){
    	return view('admin.hang.add');
    }

    public function addHang(Request $request){
    	$this->validate($request,[
    		'name' => 'required|min:3|max:255',
    		'diachi' => 'required|min:5|max:255',
    		'email' => 'required|max:255',
    		'phone' => 'required|max:255|min:10',
    		'mota' => 'required',
    		'upload' => 'required'
    	],[
    		'name.required' => 'Bạn chưa nhập tên',
    		'name.min' => 'Tên cần tối thiểu 3 ký tự',
    		'name.max' => 'Tên có tối đa 255 ký tự',
    		'email.required' => 'Bạn chưa nhập email',
    		'email.max' => 'Email có tối đa 25 ký tự',
    		'diachi.required' => 'Bạn chưa nhập địa chỉ',
    		'diachi.min' => 'Địa chỉ cần chứa tối thiểu 5 ký tự',
    		'diachi.max' => 'Địa chỉ có tối đa 255 ký tự',
    		'phone.required' => 'Bạn chưa nhập vào số điện thoại',
    		'phone.max' => 'Số điện thoại có tối đa 255 ký tự',
    		'phone.min' => 'Số điện thoại cần chứa tối thiểu 10 ký tự',
    		'mota.required' => 'Bạn chưa nhập vào mô tả',
    		'upload.required' => 'Bạn chưa chọn ảnh'
    	]);
    	$hang = new hang;
    	$hang->tenhang = $request->name;
    	$hang->diachi = $request->diachi;
    	$hang->dienthoai = $request->phone;
    	$hang->email = $request->email;
    	$hang->mota = $request->mota;
    	$name = Str::random(10);
    	$file = $request->file('upload');
        $file->move('img',$name.'.png');
        $hang->img = 'img/'.$name.'.png';
        $hang->save();
        return redirect()->route('hang')->with('thongbao','Đã thêm thành công');
    }

    public function showEdit($id){
        $hang = hang::find($id);
        return view('admin.hang.edit',['hang'=>$hang]);
    }

    public function editHang(Request $request){
        $this->validate($request,[
            'name' => 'required|min:3|max:255',
            'diachi' => 'required|min:5|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|max:255|min:10',
            'mota' => 'required',
        ],[
            'name.required' => 'Bạn chưa nhập tên',
            'name.min' => 'Tên cần tối thiểu 3 ký tự',
            'name.max' => 'Tên có tối đa 255 ký tự',
            'email.required' => 'Bạn chưa nhập email',
            'email.max' => 'Email có tối đa 25 ký tự',
            'diachi.required' => 'Bạn chưa nhập địa chỉ',
            'diachi.min' => 'Địa chỉ cần chứa tối thiểu 5 ký tự',
            'diachi.max' => 'Địa chỉ có tối đa 255 ký tự',
            'phone.required' => 'Bạn chưa nhập vào số điện thoại',
            'phone.max' => 'Số điện thoại có tối đa 255 ký tự',
            'phone.min' => 'Số điện thoại cần chứa tối thiểu 10 ký tự',
            'mota.required' => 'Bạn chưa nhập vào mô tả',
        ]);
        $hang = hang::find($request->id);
        $hang->tenhang = $request->name;
        $hang->diachi = $request->diachi;
        $hang->dienthoai = $request->phone;
        $hang->email = $request->email;
        $hang->mota = $request->mota;
        if(isset($request->upload))
        {
            $name = Str::random(10);
            $file = $request->file('upload');
            $file->move('img',$name.'.png');
            $hang->img = 'img/'.$name.'.png';
        }
        $hang->save();
        return redirect()->route('hang')->with('thongbao','Đã chỉnh sửa thành công');
    }

    public function deleteHang($id){
        $hang = hang::find($id);
        $hang->delete();
        return redirect()->route('hang')->with('thongbao','Đã xóa thành công');
    }
}
