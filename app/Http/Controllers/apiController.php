<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\tinhdi;
use App\chuyen;
use App\ve;
use App\thongtin;
use App\User;
use Validator;
use Mail;

class apiController extends Controller
{
    public function getNoiDi(){
    	$noidi = tinhdi::all();
    	return response()->json($noidi);
    }

    public function getChuyenDi(Request $request){
    	if(isset($request->noidi)||isset($request->noiden)||isset($request->ngaydi)){
            $chuyen = chuyen::join('lotrinh','chuyen.idLoTrinh','lotrinh.id')
                    ->join('tinhdi','lotrinh.idTinhDi','tinhdi.id')
                    ->join('tinhden','lotrinh.idTinhDen','tinhden.id')
                    ->join('xe','lotrinh.idXe','xe.id')
                    ->join('tuyen','xe.idTuyen','tuyen.id')
                    ->where('lotrinh.idTinhDi','=',$request->noidi)
                    ->where('lotrinh.idTinhDen','=',$request->noiden)
                    ->whereDate('chuyen.giodi','=',$request->ngaydi)
                    ->where('chuyen.tinhtrang',0)
                    ->orderBy('chuyen.giodi','desc')
                    ->select('chuyen.id','tuyen.tentuyen','xe.tenxe','xe.biensoxe','xe.soghe','tinhdi.tentinh as tentinhdi','tinhden.tentinh as tentinhden','lotrinh.noidi','lotrinh.noiden','chuyen.giodi','chuyen.gioden','chuyen.giave','chuyen.tinhtrang')
                    ->get();
        }
        else{
        	$chuyen = array();
        }

        return response()->json($chuyen);
    }

    public function chiTietChuyenXe($id){
    	$chuyen = chuyen::join('lotrinh','chuyen.idLoTrinh','lotrinh.id')
        ->join('tinhdi','lotrinh.idTinhDi','tinhdi.id')
        ->join('tinhden','lotrinh.idTinhDen','tinhden.id')
        ->join('xe','lotrinh.idXe','xe.id')
        ->join('tuyen','xe.idTuyen','tuyen.id')
        ->join('loaixe','xe.idLoaiXe','loaixe.id')
        ->where('chuyen.id',$id)
        ->select('chuyen.id','chuyen.idLoTrinh','xe.id as idXe','lotrinh.noidi','lotrinh.noiden','tinhdi.tentinh as tentinhdi','tinhden.tentinh as tentinhden','tuyen.tentuyen','loaixe.tenloaixe','chuyen.giodi','chuyen.gioden','chuyen.giave','chuyen.tinhtrang','xe.soghe')
        ->first();
        $sove = ve::where('idChuyen',$chuyen->id)
        ->where('tinhtrang','!=',3)
        ->count();
        $ghetrong = $chuyen->soghe - $sove;
        $chuyen['ghetrong'] = $ghetrong;
        $ve = ve::where('idChuyen',$chuyen->id)->where('tinhtrang','!=','3')->select('soghe')->get();
        $chuyen['vedadat'] = $ve;
        return response()->json($chuyen);
    }

    public function getInfo(){
    	$thongtin = thongtin::select('id','tieude')->get();
    	return response()->json($thongtin);
    }

    public function Login(Request $request){
    	if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
    		$id = Auth::user()->id;
    		$login = User::find($id);
    		$login['status'] = 'success';
    		return response()->json($login);
    	}
    	else{
    		$login = array('status' => $request->email);
    		return response()->json($login);
    	}
    }

    public function getUser(Request $request){
    	$user = User::find($request->id);
    	return response()->json($user);
    }

    public function register(Request $request){
        $rule = [
            'name'=>'required|min:3',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:3|max:22',
            'address'=>'required|max:255',
            'phone'=>'required|max:12|min:9',
            'gender'=>'required',
            'birthday'=>'required'
        ];
        $norti = [
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
        ];
        $validator = Validator::make($request->all(),$rule,$norti);
        if($validator->fails()){
            $err = $validator->errors()->all();
            return $err[0];
        }
        User::create(['name'=>$request->name,'password'=>bcrypt($request->password),'email'=>$request->email,'level'=>'2','address'=>$request->address,'phone'=>$request->phone,'gender'=>$request->gender,'birthday'=>$request->birthday]);
        return "success";
    }

    public function getTicket(Request $request){
        if(!isset($request->id)){
            return response()->json('id not found.');
        }
        $id = $request->id;
        $ve = ve::join('chuyen','chuyen.id','ve.idChuyen')
            ->join('lotrinh','chuyen.idLoTrinh','lotrinh.id')
            ->join('tinhdi','lotrinh.idTinhDi','tinhdi.id')
            ->join('tinhden','lotrinh.idTinhDen','tinhden.id')
            ->join('xe','lotrinh.idXe','xe.id')
            ->join('tuyen','xe.idTuyen','tuyen.id')
            ->join('users','users.id','ve.idUser')
            ->where('ve.idUser',$id)
            ->whereRaw('(ve.tinhtrang = 0 or ve.tinhtrang = 1)')
            ->orderBy('ve.created_at','desc')
            ->select('ve.id','tinhdi.tentinh as tentinhdi','tinhden.tentinh as tentinhden','chuyen.giodi','chuyen.gioden','lotrinh.noidi','lotrinh.noiden','tuyen.tentuyen','ve.soghe','ve.created_at','ve.tinhtrang')
            ->get();
        return response()->json($ve);
    }

    public function getSuccess(Request $request){
        if(!isset($request->id)){
            return response()->json('id not found.');
        }
        $id = $request->id;
        $ve = ve::join('chuyen','chuyen.id','ve.idChuyen')
            ->join('lotrinh','chuyen.idLoTrinh','lotrinh.id')
            ->join('tinhdi','lotrinh.idTinhDi','tinhdi.id')
            ->join('tinhden','lotrinh.idTinhDen','tinhden.id')
            ->join('xe','lotrinh.idXe','xe.id')
            ->join('tuyen','xe.idTuyen','tuyen.id')
            ->join('users','users.id','ve.idUser')
            ->where('ve.idUser',$id)
            ->where('ve.tinhtrang','2')
            ->orderBy('ve.created_at','desc')
            ->select('ve.id','tinhdi.tentinh as tentinhdi','tinhden.tentinh as tentinhden','chuyen.giodi','chuyen.gioden','lotrinh.noidi','lotrinh.noiden','tuyen.tentuyen','ve.soghe','ve.created_at','ve.tinhtrang')
            ->get();
        return response()->json($ve);
    }

    public function getCancel(Request $request){
        if(!isset($request->id)){
            return response()->json('id not found.');
        }
        $id = $request->id;
        $ve = ve::join('chuyen','chuyen.id','ve.idChuyen')
            ->join('lotrinh','chuyen.idLoTrinh','lotrinh.id')
            ->join('tinhdi','lotrinh.idTinhDi','tinhdi.id')
            ->join('tinhden','lotrinh.idTinhDen','tinhden.id')
            ->join('xe','lotrinh.idXe','xe.id')
            ->join('tuyen','xe.idTuyen','tuyen.id')
            ->join('users','users.id','ve.idUser')
            ->where('ve.idUser',$id)
            ->where('ve.tinhtrang','3')
            ->orderBy('ve.created_at','desc')
            ->select('ve.id','tinhdi.tentinh as tentinhdi','tinhden.tentinh as tentinhden','chuyen.giodi','chuyen.gioden','lotrinh.noidi','lotrinh.noiden','tuyen.tentuyen','ve.soghe','ve.created_at','ve.tinhtrang')
            ->get();
        return response()->json($ve);
    }

    public function getTicketById($id){
        $ve = ve::join('chuyen','chuyen.id','ve.idChuyen')
            ->join('lotrinh','chuyen.idLoTrinh','lotrinh.id')
            ->join('tinhdi','lotrinh.idTinhDi','tinhdi.id')
            ->join('tinhden','lotrinh.idTinhDen','tinhden.id')
            ->join('xe','lotrinh.idXe','xe.id')
            ->join('loaixe','xe.idLoaiXe','loaixe.id')
            ->join('tuyen','xe.idTuyen','tuyen.id')
            ->join('users','users.id','ve.idUser')
            ->where('ve.id',$id)
            ->orderBy('ve.created_at','desc')
            ->select('ve.id','tinhdi.tentinh as tentinhdi','tinhden.tentinh as tentinhden','chuyen.giodi','chuyen.gioden','lotrinh.noidi','lotrinh.noiden','tuyen.tentuyen','ve.soghe','ve.created_at','ve.tinhtrang','users.name','ve.idUser','chuyen.id as idChuyen','ve.thanhtoan','users.email','loaixe.tenloaixe')
            ->first();
        return response()->json($ve);
    }

    public function checkOut(Request $request){
        $user = User::find($request->idUser);
        $chuyen = chuyen::join('lotrinh','chuyen.idLoTrinh','lotrinh.id')
        ->join('tinhdi','lotrinh.idTinhDi','tinhdi.id')
        ->join('tinhden','lotrinh.idTinhDen','tinhden.id')
        ->join('xe','lotrinh.idXe','xe.id')
        ->join('tuyen','xe.idTuyen','tuyen.id')
        ->join('loaixe','xe.idLoaiXe','loaixe.id')
        ->where('chuyen.id',$request->id)
        ->select('chuyen.id','chuyen.idLoTrinh','xe.id as idXe','lotrinh.noidi','lotrinh.noiden','tinhdi.tentinh as tentinhdi','tinhden.tentinh as tentinhden','tuyen.tentuyen','loaixe.tenloaixe','chuyen.giodi','chuyen.gioden','chuyen.giave','chuyen.tinhtrang','xe.soghe')
        ->first();
        $chuyen['name'] = $user->name;
        $chuyen['email'] = $user->email;
        $chuyen['soghe'] = $request->soghe;
        return response()->json($chuyen);
    }

    public function booking(Request $request){
        $soghe = ve::where('idChuyen',$request->id)->where('soghe',$request->soghe)->count();
        $chuyen = chuyen::join('lotrinh','chuyen.idLoTrinh','lotrinh.id')
        ->join('tinhdi','lotrinh.idTinhDi','tinhdi.id')
        ->join('tinhden','lotrinh.idTinhDen','tinhden.id')
        ->join('xe','lotrinh.idXe','xe.id')
        ->join('tuyen','xe.idTuyen','tuyen.id')
        ->join('loaixe','xe.idLoaiXe','loaixe.id')
        ->where('chuyen.id',$request->id)
        ->select('chuyen.id','chuyen.idLoTrinh','xe.id as idXe','lotrinh.noidi','lotrinh.noiden','tinhdi.tentinh as tentinhdi','tinhden.tentinh as tentinhden','tuyen.tentuyen','loaixe.tenloaixe','chuyen.giodi','chuyen.gioden','chuyen.giave','chuyen.tinhtrang')
        ->firstOrFail();
        $user = User::find($request->idUser);
        if($soghe == 1){
            return "fail";
        }
        else{
            $ve = ve::create([
                'idChuyen'=>$request->id,
                'soghe'=>$request->soghe,
                'idUser'=>$request->idUser,
                'thanhtoan'=> '0',
                'tinhtrang'=> '0']);
            // $to_name = "Nhà xe Quang Minh";
            // $to_email = $user->email;
            // $data = [
            //     'id' => $ve->id,
            //     'tuyen' => $chuyen->tentuyen,
            //     'name' => $user->name,
            //     'ngaydi' => $chuyen->giodi,
            //     'ngayden' => $chuyen->gioden,
            //     'soghe' => $request->soghe,
            //     'giave' => $chuyen->giave,
            //     'noidi' => $chuyen->noidi.' - '.$chuyen->tentinhdi,
            //     'noiden' => $chuyen->noiden.' - '.$chuyen->tentinhden,
            //     'loaixe' => $chuyen->tenloaixe,
            //     'ngaydat' =>$ve->created_at
            // ];
            // Mail::send('user.mail',$data,function($message) use ($to_name,$to_email){
            //     $message->to($to_email)->subject('Xác Nhận Đặt Vé');
            //     $message->from($to_email,$to_name);
            // });         
            return "success";
        }
    }

    public function huyve(Request $request){
        $ve = ve::find($request->id);
        if($ve->tinhtrang != 0){
            return "fail";
        }
        else{
            $ve->tinhtrang = 3;
            $ve->save();
            return "success";
        }
    }

    public function viewThongTin(Request $request){
        $thongtin = thongtin::find($request->id);
        return response()->json($thongtin);
    }
}
