<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\tinhdi;

class usersController extends Controller
{
    public function getAdmin(Request $request){
    	if(isset($request->search)){
    		$admin = User::where('name','like','%'.$request->search.'%')
    				->where('level','<','2')
    				->get();
    	}
    	elseif(isset($request->sort)){
    		switch ($request->sort) {
    			case 1:
    				$admin = User::where('level','<','2')
    				->orderBy('name','asc')
    				->get();
    				break;
    			case 2:
    				$admin = User::where('level','<','2')
    				->orderBy('name','desc')
    				->get();
    			case 3:
    				$admin = User::where('level','<','2')
    				->orderBy('level','asc')
    				->get();
    			case 4:
    				$admin = User::where('level','<','2')
    				->orderBy('level','desc')
    				->get();
    			default:
    				$admin = User::where('level','<','2')
    				->orderBy('name','asc')
    				->get();
    				break;
    		}
    	}
    	else{
    		$admin = User::where('level','<','2')
    		->orderBy('name','asc')
    		->get();
    	}
    	return view('teamplate.users.quantri',['admin'=>$admin,'sort'=>$request->sort]);
    }

    public function addAdmin(Request $request){
		$this->validate($request,[
			'email' => 'required|email|min:8|unique:users,email',
			'name' => 'required|min:3',
			'password' => 'required|min:8'
		]);
		$admin = new User;
		$admin->email = $request->email;
		$admin->name = $request->name;
		$admin->password = bcrypt($request->password);
		$admin->level = $request->level;
		$admin->save();
		return redirect()->route('admin')->with('thongbao','Đã thêm vào thành công');
    }

    public function editAdmin(Request $request){
    	$this->validate($request,[
			'name' => 'required|min:3',
		]);
		$admin = User::find($request->id)->update(['name'=>$request->name,'level'=>$request->level]);
		return redirect()->route('admin')->with('thongbao','Đã chỉnh sửa thành công');		
    }

    public function getUsers(Request $request){
        if(isset($request->search)){
            $users = User::where('email','like','%'.$request->search.'%')
                    ->where('level','<','2')
                    ->get();
        }
        elseif(isset($request->sort)){
            switch ($request->sort) {
                case 1:
                    $users = User::where('level','=','2')
                    ->orderBy('name','asc')
                    ->get();
                    break;
                case 2:
                    $users = User::where('level','=','2')
                    ->orderBy('name','desc')
                    ->get();
                default:
                    $users = User::where('level','=','2')
                    ->orderBy('name','asc')
                    ->get();
                    break;
            }
        }
        else{
            $users = User::where('level','=','2')
            ->orderBy('name','asc')
            ->get();
        }
        return view('admin.users.khachhang',['users'=>$users,'sort'=>$request->sort]);
    }

    public function addUser(Request $request){
        $this->validate($request,[
            'email' => 'required|email|min:8|unique:users,email',
            'name' => 'required|min:3',
            'password' => 'required|min:8'
        ]);
        $admin = new User;
        $admin->email = $request->email;
        $admin->name = $request->name;
        $admin->password = bcrypt($request->password);
        $admin->level = 2;
        $admin->save();
        return redirect()->route('users')->with('thongbao','Đã thêm vào thành công');
    }

    public function editUser(Request $request){
        $this->validate($request,[
            'name' => 'required|min:3',
        ]);
        User::find($request->id)->update(['name'=>$request->name]);
        return redirect()->route('users')->with('thongbao','Đã chỉnh sửa thành công');
    }


    public function Login(Request $request){
        $this->validate($request,[
        'email' =>'required|email',
        'password' => 'required|min:6'
        ],[
            'email.required' => 'Bạn phải nhập vào email',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Bạn phải nhập vào mật khẩu',
            'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
        ]);
        $email = $request->email;
        $password = $request->password;
        if(Auth::attempt(['email'=>$email,'password'=>$password])){
            return redirect()->route('demoview');
        }else {
            return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
        }
    }

    public function getLogin(){
        return view('user.demo');
    }

    public function getView(){
        $tinh = tinhdi::all();
        return view('user.demoview',['tinh'=>$tinh]);
    }

}
