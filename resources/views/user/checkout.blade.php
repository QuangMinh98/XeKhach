@extends('user.master.header')

@section('title')
Xác nhận thông tin
@endsection

@section('noidung')
<section>
	<div class="container" style="padding-top: 20px;">
		<div class="checkout" style="margin: 0px;">
			<div class="panel">
				<p class="text-center text-uppercase text-primary">Checkout</p>
				<table class="table">
					<tbody>
						<tr>
							<td><p><strong>Tuyến xe:</strong><span>&nbsp{{$chuyen->tentuyen}}</span></p></td>
						</tr>
						<tr>
							<td><p><strong>Nơi Đi:</strong><span>&nbsp{{$chuyen->noidi}}</span></p></td>
						</tr>
						<tr>
							<td><p><strong>Nơi Đến:</strong><span>&nbsp{{$chuyen->noiden}}</span></p></td>
						</tr>
						<tr>
							<td><p><strong>Giờ Đi:</strong><span>&nbsp{{$chuyen->giodi}}</span></p></td>
						</tr>
						<tr>
							<td><p><strong>Giờ Đến:</strong><span>&nbsp{{$chuyen->gioden}}</span></p></td>
						</tr>
						<tr>
							<td><p><strong>Số Ghế:</strong><span>&nbsp{{$soghe}}</span></p></td>
						</tr>
						<tr>
							<td><p><strong>Tên Khách Hàng:</strong><span>&nbsp{{Auth::user()->name}}</span></p></td>
						</tr>
						<tr>
							<td>
								<div class="form-datve">
									<form id="form-datve" action="{{route('success')}}" method="post">
										@csrf
										<input type="hidden" name="soghe" value="{{$soghe}}">
										<input type="hidden" name="idChuyen" value="{{$chuyen->id}}">
										<button type="submit" class="button-submit">Đặt Vé</button>
									</form>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
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
	p {
	    margin: 0 0 10px;
	}
	.panel{
	    border: 1px solid #ddd;
	    padding: 10px;
	    width: 60%;
	    margin: 20px auto;
	}

	@media screen and (max-width: 768px) {
		.panel{
			width: 95%;
		}
	}

	.table td{
		border-top: none !important; 
	}

	.checkout{
		width: 100%;
	}

	.button-submit{
		width: 150px;
		padding: 8px 0;
		border: none;
		border-radius: 50px;
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
