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
                    ->orderBy('level','asc')
    				->get();
    	}
    	elseif(isset($request->sort)){
    		switch ($request->sort) {
    			case 0:
    				$admin = User::where('level','=','0')
    				->orderBy('name','asc')
    				->get();
    				break;
    			case 1:
    				$admin = User::where('level','=','1')
    				->orderBy('name','asc')
    				->get();
                    break;
    			default:
    				$admin = User::where('level','<','2')
    				->orderBy('name','asc')
    				->get();
    				break;
    		}
    	}
    	else{
    		$admin = User::where('level','<','2')
    		->orderBy('level','asc')
    		->get();
    	}
    	return view('admin2.users.quantri',['admin'=>$admin,'sort'=>$request->sort]);
    }

    public function addAdmin(Request $request){
		$this->validate($request,[
			'email' => 'required|email|min:8|unique:users,email',
			'name' => 'required|min:3',
			'password' => 'required|min:8',
            'address'=>'required|max:255',
            'phone'=>'required|min:9|max:11',
            'birthday'=>'required',
            'gender'=>'required'
		]);
        if($request->password !== $request->password2){
            return redirect()->back()->with('status','Mật Khẩu Không Trùng Khớp');
        }
        else{
            $password = bcrypt($request->password);
            User::create([
                'email'=>$request->email,
                'name'=>$request->name,
                'password'=>$password,
                'level'=>$request->level,
                'phone'=>$request->phone,
                'address'=>$request->address,
                'birthday'=>$request->birthday,
                'gender'=>$request->gender
            ]);
        }
		return redirect()->route('admin')->with('thongbao','Đã thêm vào thành công');
    }

    public function editAdmin(Request $request){
    	$this->validate($request,[
			'name' => 'required|min:3',
            'address'=>'required|max:255',
            'phone'=>'required|min:9|max:11',
            'birthday'=>'required',
            'gender1'=>'required'
		]);
		$admin = User::find($request->id)->update([
            'name'=>$request->name,
            'level'=>$request->level,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'birthday'=>$request->birthday,
            'gender'=>$request->gender1
        ]);
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
        return view('admin2.users.khachhang',['users'=>$users,'sort'=>$request->sort]);
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
            'name' => 'required|min:5|max:255',
            'address'=>'required|max:255',
            'phone'=>'required|max:12|min:9',
            'gender'=>'required',
            'birthday'=>'required'
        ],[
            'name.required' => 'Bạn chưa nhập tên',
            'name.min' => 'Tên cần tối thiểu 5 ký tự',
            'name.max' => 'Tên có tối đa 255 ký tự',
            'address.required'=>'Bạn chưa nhập địa chỉ',
            'address.max'=>'Địa chỉ có tối đa 255 ký tự',
            'phone.required'=>'Bạn chưa nhập vào số điện thoại',
            'phone.max'=>'Số điện thoại có tối đa 12 ký tự',
            'phone.min'=>'Số điện thoại có tối thiểu 9 ký tự',
            'gender.required'=>'Bạn chưa chọn giới tính',
            'birthday'=>'Bạn chưa chọn ngày sinh'
        ]);
        User::find($request->id)->update(['name'=>$request->name,'address'=>$request->address,'phone'=>$request->phone,'gender'=>$request->gender,'birthday'=>$request->birthday]);
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
            if(Auth::user()->level == 2){
                Auth::logout();
                return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
            }elseif(Auth::user()->level == 0){
                return redirect()->route('admin');
            }
            return redirect()->route('tuyen');
        }else {
            return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
        }
    }

    public function viewLogin(){
        return view('admin1.login.login');
    }

    public function getView(){
        $tinh = tinhdi::all();
        return view('user.demoview',['tinh'=>$tinh]);
    }

    public function deleteUser(Request $request){
        User::del($request->id);
    }

    public function logOut(){
        Auth::logout();
        return redirect()->route('getLogin');
    }

    public function getInfo(){
        return view('admin2.info.info');
    }

    public function changeInfo(Request $request){
        $this->validate($request,[
            'name' => 'required|min:5|max:255',
            'address'=>'required|max:255',
            'phone'=>'required|max:12|min:9',
            'gender'=>'required',
            'birthday'=>'required'
        ],[
            'name.required' => 'Bạn chưa nhập tên',
            'name.min' => 'Tên cần tối thiểu 5 ký tự',
            'name.max' => 'Tên có tối đa 255 ký tự',
            'address.required'=>'Bạn chưa nhập địa chỉ',
            'address.max'=>'Địa chỉ có tối đa 255 ký tự',
            'phone.required'=>'Bạn chưa nhập vào số điện thoại',
            'phone.max'=>'Số điện thoại có tối đa 12 ký tự',
            'phone.min'=>'Số điện thoại có tối thiểu 9 ký tự',
            'gender.required'=>'Bạn chưa chọn giới tính',
            'birthday'=>'Bạn chưa chọn ngày sinh'
        ]);
        $id = Auth::user()->id;
        User::find($id)->update(['name'=>$request->name,'address'=>$request->address,'phone'=>$request->phone,'gender'=>$request->gender,'birthday'=>$request->birthday]);
        return redirect()->back()->with('thongbao','Đã thay đổi thành công');
    }

    public function getChangePass(){
        return view('admin2.info.changePassword');
    }

    public function changePassword(Request $request){
        $email = Auth::user()->email;
        $id = Auth::user()->id;
        $password = $request->password;
        if(Auth::attempt(['email'=>$email,'password'=>$password])){
            $this->validate($request,[
                'newpass' => 'required|min:8|max:20',
            ],[
                'newpass.required' => 'Bạn chưa nhập mật khẩu mới',
                'newpass.min' => 'Mật khẩu cần tối thiểu 8 ký tự',
                'newpass.max' => 'Mật khẩu chứa tối đa 20 ký tự'
            ]);
            if($request->newpass != $request->newpass2){
                return redirect()->back()->with('status','Mật khẩu không khớp');
            }
            else{
                $pass = bcrypt($request->newpass);
                User::find($id)->update(['password'=>$pass]);
                Auth::attempt(['email'=>$email,'password'=>$pass]);
                return redirect()->back()->with('thongbao','Đã thay đổi mật khẩu thành công.');
            }
        }else {
            return redirect()->back()->with('status', 'Mật khẩu không chính xác');
        }
    }

}
