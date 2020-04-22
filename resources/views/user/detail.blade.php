@extends('user.master.header')


@section('noidung')
	<section>
		<div class="container" style="padding-top: 20px;">
			<div class="row" style="margin: 0px;">
				<div class="col-md-5">
					<div class="panel">
						<p class="text-center text-uppercase text-primary">Thông tin chuyến xe</p>
						<table class="table">
							<tbody>
								<tr>
									<td><p><strong>Tuyến xe:</strong><span>&nbsp{{$chuyen->tentuyen}}</span></p></td>
								</tr>
								<tr>
									<td><p><strong>Hãng Xe:</strong><span>&nbsp{{$chuyen->tenhang}}</span></p></td>
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
									<td><p><strong>Số Ghế Trống:</strong><span>&nbsp{{$xe->soghe - $sove}}</span></p></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-md-7">
					<div class="panel">
						<p class="text-center text-uppercase text-primary">Chọn Ghế Ngồi</p>
						<div class="row">
							@for($i=1 ; $i<=$xe->sotang ; $i++)
							<div class="col-md-6">
								<dt style="text-align: center;">Tầng {{$i}}</dt>
								<div class="row" style="margin: 0;">
									@foreach($ghe as $seat)
										@if($seat->sotang == $i)
										<div class="col-md-3 col-3">
											@if(in_array($seat->soghe,$ve))
											<span class="seat">{{$seat->soghe}}</span>
											@else
											<span id="seat" class="seat non-choose" href="">{{$seat->soghe}}</span>
											@endif
										</div>
										@endif
									@endforeach
								</div>
							</div>
							@endfor
						</div>
						<p class="text-seat">Số Ghế : <span id="txt-seat">Chưa Chọn Ghế</span></p>
						@if(Auth::check())
						<div class="form-datve">
							<form id="form-datve" action="{{route('checkout')}}" method="post">
								@csrf
								<input type="hidden" name="soghe" id="soghe">
								<input type="hidden" name="idChuyen" value="{{$chuyen->id}}">
								<button type="submit" class="button-submit">Đặt Vé</button>
							</form>
						</div>
						@endif
					</div>
				</div>
			</div>
			<div class="news">
				<h3><i class="far fa-newspaper"></i>&nbsp Tin Mới</h3>
				<div class="row" style="padding: 30px 0px;">
					<div class="col-md-5">
						<div class="first-news">
							<img src="https://futabus.vn/uploads/useravatar/thumb/bia-Khong-qua-20-khach-555x325.jpg">
							<h4>XE KHÁCH PHƯƠNG TRANG KHÔNG CHỞ QUÁ 20 KHÁCH PHÒNG COVID-19</h4>
							<span class="time-up">Ngày đăng:</span>
							<p>Xe khách Phương Trang không chở quá 20 khách phòng COVID-19.</p>
						</div>
					</div>
					<div class="col-md-7">
						<div class="list-news">
							<ul>
								<li class="items-news">
									<h4>Nguyên Chủ tịch nước Trương Tấn Sang đã đến thăm và chúc Tết người dân tại bến xe Miền Tây</h4>
									<span class="time-up">Ngày đăng:</span>
									<p>Chiều ngày 20/1 tức ngày 26 Tết, Nguyên Chủ tịch nước Trương Tấn Sang đã đến thăm và chúc Tết người dân tại bến xe Miền Tây.</p>
								</li>
								<hr>
								<li class="items-news">
									<h4>XE KHÁCH PHƯƠNG TRANG KHÔNG CHỞ QUÁ 20 KHÁCH PHÒNG COVID-19</h4>
									<span class="time-up">Ngày đăng:</span>
									<p>Xe khách Phương Trang không chở quá 20 khách phòng COVID-19.</p>
								</li>
								<hr>
								<li class="items-news">
									<h4>XE KHÁCH PHƯƠNG TRANG KHÔNG CHỞ QUÁ 20 KHÁCH PHÒNG COVID-19</h4>
									<span class="time-up">Ngày đăng:</span>
									<p>Xe khách Phương Trang không chở quá 20 khách phòng COVID-19.</p>
								</li>
							</ul>
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
	p {
	    margin: 0 0 10px;
	}
	.panel{
	    border: 1px solid #ddd;
	    padding: 10px;
	    margin-bottom: 20px;
	}

	.seat{
		height: 28px;
		width: 35px;
		color: #999;
		cursor: pointer;
		border: 1px solid #424242;
		border-radius: 3px;
		background: #2b2b2b;
		padding: 5px 10px;
		margin: 2px 4px 2px 2px;
		display: inline-block;
		font-weight: 700;
		font-size: 11px;
		text-align: center;
	}
	.non-choose{
		background: #F42536;
		color: #fff;
	}
	.choose{
		background: #007bff;
		color: #fff;
	}

	.text-seat{
		padding-top: 30px;
		padding-left: 15px;
		font-weight: bold;
	}

	.non-choose:hover{
		cursor: pointer;
		box-shadow: 0 0 0px 2px #5C6AFF;
	}

	.form-datve{
		margin-top: 30px;
	}

	.button-submit{
		width: 200px;
		padding: 12px 0;
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

@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		$(".non-choose").click(function(){
			$(".non-choose").removeClass('choose');
			$(this).toggleClass('choose');
			text = $(this).text();
			$("#soghe").val(text);
			$("#txt-seat").text(text);
		})
		$("#form-datve").submit(function(){
			soghe = $("#soghe").val();
			if(soghe == ""){
				alert("Bạn chưa chọn ghế");
				return false;
			}
		})
	})
</script>
@endsection