@extends('user.master.header')

@section('title')
Đặt vé thành công
@endsection

@section('noidung')
<section>
	<div class="container" style="padding-top: 20px;">
		<div class="success">
			<div class="icon-box">
				<i class="fas fa-check-circle"></i>
			</div>
			<div class="success-title">
				<h4>Đặt Vé Thành Công!</h4>
			</div>
			<div class="success-body">
				<p class="text-center">Cảm ơn đã đặt vé.</p>
				<p class="text-center">Quý khách vui lòng đến thanh toán và nhận vé tại nhà xe.</p>
			</div>
			<div class="success-button">
				<a href="{{route('home')}}"><button class="button-submit"><i class="fas fa-check-circle"></i>&nbsp Tiếp Tục</button></a>
			</div>
		</div>
	</div>
</section>
@endsection

@section('style')
<style type="text/css">
	.success{
		text-align: center;
		padding-top: 50px;
		padding-bottom: 150px;
		font-family: 'Varela Round', sans-serif;
	}

	.success .icon-box{
		color: #82ce34;
		font-size: 100px;
	}

	.success-title h4{
		text-align: center;
	    font-size: 26px;
	    margin: 0px 0 15px;
	    line-height: 1.42857143;
	    color: #82ce34;
	}

	.success-body p{
		font-size: 18px;
		margin-bottom: 10px;
	}

	.success-button{
		margin-top: 60px;
	}

	.button-submit{
		width: 350px;
		padding: 8px 0;
		border: none;
		border-radius: 50px;
		background-color: #82ce34;		
		font-size: 15px;
		font-weight: 700;
		color: #fff;
		margin-bottom: 20px;
		cursor: pointer;
	}

	.button-submit:hover{
		background: #28a745;
	}

</style>
@endsection
