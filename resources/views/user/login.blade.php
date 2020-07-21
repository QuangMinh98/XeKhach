@extends('user.master.header')

@section('title')
Đăng nhập
@endsection

@section('noidung')
	<section>
		<div class="container" style="padding: 60px 0px;">
			<div class="form-login">
				<h3>Đăng Nhập</h3>
				@if(session('status'))
				<div class="alert alert-danger">
				  <strong>Danger!</strong> {{session('status')}}
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
				<form action="{{route('login')}}" method="post">
					@csrf
					<input type="text" name="email" class="input-email" placeholder="Email">
					<input type="password" name="password" class="input-email" placeholder="Mật Khẩu">
					<button type="submit" class="button-submit">Đăng Nhập</button>
				</form>
				<h2>Hoặc</h2>
				<hr>
				<a href="{{route('viewRegister')}}"><button class="button-submit">Đăng Ký</button></a>
			</div>
		</div>
	</section>
@endsection

@section('style')
<style type="text/css">
	.form-login{
		margin: 0 auto;
		width: 555px;
		text-align: center;
		padding-top: 60px;
		padding-bottom: 30px;
		height: 500px;
		border: 1px solid #ddd;
	    margin-bottom: 20px;
	}

	.form-login hr{
		width: 70%;
		margin-top: -15px;
	}

	.input-email{
		text-align: left;
		width: 70%;
		height: 44px;
		border-radius: 50px;
		border: solid 1px 
		#e0e0e0;
		background-color:
		#f9f9f9;
		padding: 0 20px;
		margin-bottom: 20px;
		font-weight: 500;
		color:
		#757575;
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
	.form-login h2 {
	    display: inline-block;
	    font-size: 13px;
	    padding: 0 15px;
	    position: relative;
	    text-transform: uppercase;
	    color: #757575;
	    background: #fff;
	}
	@media screen and (max-width: 768px) {
		.form-login{
			width: 95%;
		}
		.form-login .button-submit{
			width: 80%;
		}
		.input-email{
			width: 80%;
		}
		.form-login hr{
			width: 80%;
		}
	}

	.form-login h3{
		font-size: 25px;
		color: #ff3c5a;
		margin-bottom: 35px;
	}

	.button-submit:hover{
		background: #ff3c87;
	}

</style>
@endsection