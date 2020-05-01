<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\tinhdi;
use App\tuyen;
use App\chuyen;
use App\xe;
use App\ve;
use App\User;

class viewController extends Controller
{
    public function viewHome(){
    	$tinhdi = tinhdi::all();
    	$tuyen = tuyen::all();
    	return view('user.trangchu',['diadiem'=>$tinhdi,'tuyen'=>$tuyen]);
    }

    public function viewSearch(Request $request){
    	$tinhdi = tinhdi::all();
    	if(isset($request->noidi)||isset($request->noiden)||isset($request->ngaydi)){
            $chuyen = chuyen::join('lotrinh','chuyen.idLoTrinh','lotrinh.id')
                    ->join('tinhdi','lotrinh.idTinhDi','tinhdi.id')
                    ->join('tinhden','lotrinh.idTinhDen','tinhden.id')
                    ->join('xe','lotrinh.idXe','xe.id')
                    ->join('hang','xe.idHang','hang.id')
                    ->join('tuyen','xe.idTuyen','tuyen.id')
                    ->where('lotrinh.idTinhDi','=',$request->noidi)
                    ->where('lotrinh.idTinhDen','=',$request->noiden)
                    ->whereDate('chuyen.giodi','=',$request->ngaydi)
                    ->where('chuyen.tinhtrang',0)
                    ->orderBy('chuyen.giodi','desc')
                    ->select('chuyen.id','tuyen.tentuyen','hang.tenhang','xe.tenxe','xe.biensoxe','xe.soghe','tinhdi.tentinh as tentinhdi','tinhden.tentinh as tentinhden','lotrinh.noidi','lotrinh.noiden','chuyen.giodi','chuyen.gioden','chuyen.giave','chuyen.tinhtrang')
                    ->get();
        }
        else{
        	$chuyen = array();
        }
    	return view('user.search',['diadiem'=>$tinhdi,'chuyen'=>$chuyen,'request'=>$request]);
    }

    public function viewDetail($id){
    	$chuyen = chuyen::join('lotrinh','chuyen.idLoTrinh','lotrinh.id')
        ->join('tinhdi','lotrinh.idTinhDi','tinhdi.id')
        ->join('tinhden','lotrinh.idTinhDen','tinhden.id')
        ->join('xe','lotrinh.idXe','xe.id')
        ->join('hang','xe.idHang','hang.id')
        ->join('tuyen','xe.idTuyen','tuyen.id')
        ->join('loaixe','xe.idLoaiXe','loaixe.id')
        ->where('chuyen.id',$id)
        ->select('chuyen.id','chuyen.idLoTrinh','xe.id as idXe','lotrinh.noidi','lotrinh.noiden','tinhdi.tentinh as tentinhdi','tinhden.tentinh as tentinhden','tuyen.tentuyen','hang.tenhang','hang.img','loaixe.tenloaixe','chuyen.giodi','chuyen.gioden','chuyen.giave','chuyen.tinhtrang')
        ->firstOrFail();
        $xe = xe::findOrFail($chuyen->idXe);
        $ghe = xe::findOrFail($chuyen->idXe)->ghe; 
        $sove = ve::where('idChuyen',$chuyen->id)->count();
        $ve = ve::where('idChuyen',$chuyen->id)->where('tinhtrang','!=','3')->get();
        $arrayVe = array();
        foreach($ve as $ticket){
            $arrayVe[] = $ticket->soghe;
        }
        return view('user.detail',['chuyen'=>$chuyen,'sove'=>$sove,'xe'=>$xe,'ghe'=>$ghe,'ve'=>$arrayVe]);
    }

    public function viewLogin(){
        return view('user.login');
    }

    public function viewRegister(){
        return view('user.register');
    }

    public function login(Request $request){
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
            return redirect()->route('home');
        }else {
            return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
        }
    }

    public function register(Request $request){
        $this->validate($request,[
            'name'=>'required|min:3',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:3|max:22',
            'address'=>'required|max:255',
            'phone'=>'required|max:12|min:9',
            'gender'=>'required',
            'birthday'=>'required'
        ],[
            'name.required'=>'Bạn Chưa Nhập Tên Người Dùng',
            'name.min'=>'Tên Cần Tối Thiểu 3 Ký Tự',
            'email.required'=>'Bạn Chưa Nhập Email',
            'email.email'=>'Bạn Phải Nhập Vào Email',
            'email.unique'=>'Email Đã Tồn Tại',
            'password.required'=>'Bạn Chưa Nhập Mật Khẩu',
            'password.min'=>'Mật Khẩu Cần Tối Thiểu 3 Ký Tự',
            'password.max'=>'Mật Khẩu Tối Đa 22 Ký Tự',
            'address.required'=>'Bạn chưa nhập địa chỉ',
            'address.max'=>'Địa chỉ có tối đa 255 ký tự',
            'phone.required'=>'Bạn chưa nhập vào số điện thoại',
            'phone.max'=>'Số điện thoại có tối đa 12 ký tự',
            'phone.min'=>'Số điện thoại có tối thiểu 9 ký tự',
            'gender.required'=>'Bạn chưa chọn giới tính',
            'birthday'=>'Bạn chưa chọn ngày sinh'
        ]);

        $user = User::create(['name'=>$request->name,'password'=>bcrypt($request->password),'email'=>$request->email,'level'=>'2','address'=>$request->address,'phone'=>$request->phone,'gender'=>$request->gender,'birthday'=>$request->birthday]);
        return redirect()->route('viewRegister')->with('thongbao','Đã Đăng Ký Thành Công');
    }

    public function checkout(Request $request){
        $chuyen = chuyen::join('lotrinh','chuyen.idLoTrinh','lotrinh.id')
        ->join('tinhdi','lotrinh.idTinhDi','tinhdi.id')
        ->join('tinhden','lotrinh.idTinhDen','tinhden.id')
        ->join('xe','lotrinh.idXe','xe.id')
        ->join('hang','xe.idHang','hang.id')
        ->join('tuyen','xe.idTuyen','tuyen.id')
        ->join('loaixe','xe.idLoaiXe','loaixe.id')
        ->where('chuyen.id',$request->idChuyen)
        ->select('chuyen.id','chuyen.idLoTrinh','xe.id as idXe','lotrinh.noidi','lotrinh.noiden','tinhdi.tentinh as tentinhdi','tinhden.tentinh as tentinhden','tuyen.tentuyen','hang.tenhang','hang.img','loaixe.tenloaixe','chuyen.giodi','chuyen.gioden','chuyen.giave','chuyen.tinhtrang')
        ->firstOrFail();
        $soghe = $request->soghe;        
        return view('user.checkout',['chuyen'=>$chuyen,'soghe'=>$soghe]);
    }

    public function datve(Request $request){
        $soghe = ve::where('idChuyen',$request->idChuyen)->where('soghe',$request->soghe)->count();
        $idUser = Auth::user()->id;
        if($soghe == 0){
            $ve = ve::create([
                'idChuyen'=>$request->idChuyen,
                'soghe'=>$request->soghe,
                'idUser'=>$idUser,
                'thanhtoan'=> '0',
                'tinhtrang'=> '0']);          
            return view('user.success');
        }
        else{
            return redirect()->route('chitiet',['id'=>$request->idChuyen])->with('thongbao','Đã xảy ra lỗi khi đặt vé.');
        }
    }

    public function success(){
        return view('user.success');
    }

    public function getTicket(){
        $id = Auth::user()->id;
        $ve = ve::join('chuyen','chuyen.id','ve.idChuyen')
            ->join('lotrinh','chuyen.idLoTrinh','lotrinh.id')
            ->join('tinhdi','lotrinh.idTinhDi','tinhdi.id')
            ->join('tinhden','lotrinh.idTinhDen','tinhden.id')
            ->join('xe','lotrinh.idXe','xe.id')
            ->join('hang','xe.idHang','hang.id')
            ->join('tuyen','xe.idTuyen','tuyen.id')
            ->join('users','users.id','ve.idUser')
            ->where('ve.idUser',$id)
            ->whereRaw('(ve.tinhtrang = 0 or ve.tinhtrang = 1)')
            ->orderBy('users.created_at','desc')
            ->select('ve.id','tinhdi.tentinh as tentinhdi','tinhden.tentinh as tentinhden','chuyen.giodi','chuyen.gioden','lotrinh.noidi','lotrinh.noiden','hang.tenhang','tuyen.tentuyen','ve.soghe','ve.created_at','ve.tinhtrang')
            ->paginate(10);
        return view('user.myticket',['ve'=>$ve,'nav'=>'0']);
    }

    public function getSuccess(){
        $id = Auth::user()->id;
        $ve = ve::join('chuyen','chuyen.id','ve.idChuyen')
            ->join('lotrinh','chuyen.idLoTrinh','lotrinh.id')
            ->join('tinhdi','lotrinh.idTinhDi','tinhdi.id')
            ->join('tinhden','lotrinh.idTinhDen','tinhden.id')
            ->join('xe','lotrinh.idXe','xe.id')
            ->join('hang','xe.idHang','hang.id')
            ->join('tuyen','xe.idTuyen','tuyen.id')
            ->join('users','users.id','ve.idUser')
            ->where('ve.idUser',$id)
            ->where('ve.tinhtrang','2')
            ->orderBy('ve.created_at','desc')
            ->select('ve.id','tinhdi.tentinh as tentinhdi','tinhden.tentinh as tentinhden','chuyen.giodi','chuyen.gioden','lotrinh.noidi','lotrinh.noiden','hang.tenhang','tuyen.tentuyen','ve.soghe','ve.created_at','ve.tinhtrang')
            ->paginate(10);
        return view('user.myticket',['ve'=>$ve,'nav'=>'2']);
    }

    public function getCancel(){
        $id = Auth::user()->id;
        $ve = ve::join('chuyen','chuyen.id','ve.idChuyen')
            ->join('lotrinh','chuyen.idLoTrinh','lotrinh.id')
            ->join('tinhdi','lotrinh.idTinhDi','tinhdi.id')
            ->join('tinhden','lotrinh.idTinhDen','tinhden.id')
            ->join('xe','lotrinh.idXe','xe.id')
            ->join('hang','xe.idHang','hang.id')
            ->join('tuyen','xe.idTuyen','tuyen.id')
            ->join('users','users.id','ve.idUser')
            ->where('ve.idUser',$id)
            ->where('ve.tinhtrang','3')
            ->orderBy('ve.created_at','desc')
            ->select('ve.id','tinhdi.tentinh as tentinhdi','tinhden.tentinh as tentinhden','chuyen.giodi','chuyen.gioden','lotrinh.noidi','lotrinh.noiden','hang.tenhang','tuyen.tentuyen','ve.soghe','ve.created_at','ve.tinhtrang')
            ->paginate(10);
        return view('user.myticket',['ve'=>$ve,'nav'=>'3']);
    }

    public function getTicketById($id){
        $ve = ve::join('chuyen','chuyen.id','ve.idChuyen')
            ->join('lotrinh','chuyen.idLoTrinh','lotrinh.id')
            ->join('tinhdi','lotrinh.idTinhDi','tinhdi.id')
            ->join('tinhden','lotrinh.idTinhDen','tinhden.id')
            ->join('xe','lotrinh.idXe','xe.id')
            ->join('hang','xe.idHang','hang.id')
            ->join('tuyen','xe.idTuyen','tuyen.id')
            ->join('users','users.id','ve.idUser')
            ->where('ve.id',$id)
            ->orderBy('ve.created_at','desc')
            ->select('ve.id','tinhdi.tentinh as tentinhdi','tinhden.tentinh as tentinhden','chuyen.giodi','chuyen.gioden','lotrinh.noidi','lotrinh.noiden','hang.tenhang','tuyen.tentuyen','ve.soghe','ve.created_at','ve.tinhtrang','users.name','ve.idUser','chuyen.id as idChuyen')
            ->firstOrFail();
        if(Auth::check()){
            $user = Auth::user()->id;
            if($user == $ve->idUser){
                return view('user.ticketid',['ve'=>$ve]);
            }
            else{
                return redirect()->back();
            }
        }
        else
        {
            return redirect()->back();
        }
    }

    public function cancelTicket(Request $request){
        $id = Auth::user()->id;
        $ve = ve::find($request->id);
        if($id == $ve->idUser){
            $ve->update(['tinhtrang'=>'3']);
            return redirect()->route('cancel');
        }
        else{
            return redirect()->back();
        }
    }

    public function viewInfo(){
        return view('user.info');
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

    public function viewChangePassword(){
        return view('user.changePassword');
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

    public function logOut(){
        Auth::logout();
        return redirect()->route('home');
    }
}
