@extends('user.master.header')


@section('noidung')
<section>
	<div class="container" style="padding-top: 20px;">
		<div class="row" style="margin: 0;">
			@include('user.master.sidebar')
			<div class="content">
				<div class="infomation">
					<div class="panel">
						<p class="text-center text-uppercase text-primary">Thông tin tài khoản</p>
						<div class="index">
							@if(session('thongbao'))
							<div class="alert alert-success">
								<strong>Success!</strong> {{session('thongbao')}}
							</div>
							@endif	
							@if(count($errors)>0)
							<div class="alert alert-danger">
								<strong>Danger!</strong>
								@foreach($errors->all() as $err)
							{{$err}}</br>
							@endforeach
							</div>
							@endif
							<form action="{{route('changeInfo')}}" method="post">
								@csrf
								<div class="form-group">
									<label for="id">Id:</label>
									<input type="text" value="{{Auth::user()->id}}" disabled="true" class="form-control">
								</div>
								<div class="form-group">
									<label for="email">Email:</label>
									<input type="text" id="email" name="email" value="{{Auth::user()->email}}" disabled="true" class="form-control">
								</div>
								<div class="form-group">
									<label for="sdt">Tên người dùng:</label>
									<input type="text" id="name" name="name" value="{{Auth::user()->name}}" class="form-control">
								</div>
								<div class="form-group">
									<label for="sdt">Số điện thoại:</label>
									<input type="text" id="sdt" name="phone" value="{{Auth::user()->phone}}" class="form-control">
								</div>
								<div class="form-group">
									<label for="diachi">Địa chỉ:</label>
									<input type="text" id="sdt" name="address" value="{{Auth::user()->address}}" class="form-control">
								</div>
								<div class="form-group">
									<label for="diachi">Ngày sinh:</label>
									<input type="date" id="ngaysinh" name="birthday" value="{{Auth::user()->birthday}}" class="form-control">
								</div>
								<div class="form-group">
									<label style="margin-right: 30px;">Giới tính:</label>
									<div class="custom-control custom-radio custom-control-inline" id="gioitinh">
								      <input type="radio" class="custom-control-input" id="customRadio1" name="gender" value="1" @if(Auth::user()->gender == 1) checked @endif>
								      <label class="custom-control-label" for="customRadio1" style="padding-top: 5px">Nam</label>
								    </div>
								    <div class="custom-control custom-radio custom-control-inline">
								      <input type="radio" class="custom-control-input" id="customRadio2" name="gender" value="0" @if(Auth::user()->gender == 0) checked @endif>
								      <label class="custom-control-label" for="customRadio2" style="padding-top: 5px">Nữ</label>
								    </div>
								</div>
								<div class="submit">
									<button type="submit" class="button-submit">Lưu</button>
								</div>
							</form>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
</section>
@endsection

@section('style')
<style type="text/css">
	.text-primary {
    	color: #ef5222 !important;
	}
	.text-uppercase {
	    text-transform: uppercase !important;
	}
	.text-center {
	    text-align: center !important;
	}
	.second-nav{
		margin-top: 50px; 
	}

	.index{
		font-family: 'Varela Round', sans-serif;
		color: #28a745;
		font-size: 13px;
	}

	.infomation{
		padding: 30px 0px;
	}

	.vertical-menu{
		width: 25%;
		padding: 45px 0px;
		font-family: 'Varela Round', sans-serif;
		color: #566787;
		font-size: 13px;
		margin-right: 2%;
	}

	.vertical-menu h4{
		font-size: 25px;
	}

	.content{
		width: 73%;
	}

	@media screen and (max-width: 768px) {
		.vertical-menu{
			display: none;
		}

		.content{
			width: 100%;
		}
	}

	.button-submit{
		width: 100px;
		padding: 5px 0;
		border: none;
		border-radius: 10px;
		background-color: #ff3c5a;		
		font-size: 15px;
		font-weight: 700;
		color: #fff;
		margin-bottom: 20px;
		cursor: pointer;
	}

	.button-submit:hover{
		background: #ff3c87;
	}


</style>
@endsection
