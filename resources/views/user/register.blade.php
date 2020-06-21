@extends('user.master.header')

@section('title')
Đăng ký tài khoản
@endsection

@section('noidung')
	<section>
		<div class="container" style="padding: 60px 0px;">
			<div class="form-register">
				<h3>Đăng Ký</h3>
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
				<form action="{{route('register')}}" method="post">
					@csrf
					<input type="text" name="email" class="input-email" placeholder="Email">
					<input type="text" name="name" class="input-email" placeholder="Tên Người Dùng">
					<input type="text" name="address" class="input-email" placeholder="Địa Chỉ">
					<input type="text" name="phone" class="input-email" placeholder="Số Điện Thoại">
					<input type="date" name="birthday" class="input-email" placeholder="Ngày Sinh">
					<input type="text" name="password" class="input-email" placeholder="Mật Khẩu">
					<input type="text" name="repassword" class="input-email" placeholder="Nhập Lại Mật Khẩu">
					<div class="form-group">
						<div class="custom-control custom-radio custom-control-inline">
							<input type="radio" class="custom-control-input" id="customRadio1" name="gender" value="1">
							<label class="custom-control-label" for="customRadio1">Nam</label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input type="radio" class="custom-control-input" id="customRadio2" name="gender" value="0">
							<label class="custom-control-label" for="customRadio2">Nữ</label>
						</div>
					</div>
					<button type="submit" class="button-submit">Đăng Ký</button>
				</form>
				<h2>Hoặc</h2>
				<hr>
				<a href="{{route('viewLogin')}}"><button class="button-submit">Đăng Nhập</button></a>
			</div>
		</div>
	</section>
@endsection

@section('style')
<style type="text/css">
	.form-register{
		margin: 0 auto;
		width: 555px;
		text-align: center;
		padding-top: 60px;
		height: 820px;
		border: 1px solid #ddd;
	    margin-bottom: 20px;
	}

	.form-register hr{
		width: 70%;
		margin-top: -15px;
	}

	.input-email{
		text-align: left;
		width: 70%;
		height: 44px;
		border-radius: 50px;
		border: solid 1px #e0e0e0;
		background-color: #f9f9f9;
		padding: 0 20px;
		margin-bottom: 20px;
		font-weight: 500;
		color: #757575;
	}
	input{
		outline: 0;
	}
	.button-submit{
		width: 70%;
		padding: 12px 0;
		border: none;
		border-radius: 50px;
		background-color: #ff3c5a;		
		font-size: 16px;
		font-weight: 700;
		color: #fff;
		margin-bottom: 20px;
		cursor: pointer;
	}
	.form-register h2 {
	    display: inline-block;
	    font-size: 13px;
	    padding: 0 15px;
	    position: relative;
	    text-transform: uppercase;
	    color: #757575;
	    background: #fff;
	}
	@media screen and (max-width: 768px) {
		.form-register{
			width: 95%;
		}
		.form-register .button-submit{
			width: 80%;
		}
		.input-email{
			width: 80%;
		}
		.form-register hr{
			width: 80%;
		}
	}

	.form-register h3{
		font-size: 25px;
		color: #ff3c5a;
		margin-bottom: 35px;
	}

	.button-submit:hover{
		background: #ff3c87;
	}

</style>
@endsection