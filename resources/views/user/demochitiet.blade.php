@extends('user.master.master')				

@section('noidung')
				<input type="hidden" name="id" id="id" value="{{$chuyen->id}}">
				<dl class="col-md-3">
					<dt>Tên Xe: {{$xe->tenxe}}</dt>
				</dl>
				<dl class="col-md-9">
					<dt>Biển Số Xe: {{$xe->biensoxe}}</dt>
				</dl>
				<dl class="col-md-3">
					<dt>Tên Hãng: {{$chuyen->tenhang}}</dt>
				</dl>
				<dl class="col-md-3">
					<img style="max-width: 100%;" src="{{asset($chuyen->img)}}">
				</dl>
				<dl class="col-md-12">
					<dt>Tuyến Xe: {{$chuyen->tentuyen}}</dt>
				</dl>
				<dl class="col-md-3">
					<dt>Số Tầng: {{$xe->sotang}}</dt>
				</dl>
				<dl class="col-md-3">
					<dt>Số Ghế: {{$xe->soghe}}</dt>
				</dl>
				<dl class="col-md-6">
					<dt>Số Ghế Trống: {{$xe->soghe - $sove}}</dt>
				</dl>
				<dl class="col-md-3">
					<dt>Ngày Đi: {{$chuyen->giodi}}</dt>
				</dl>
				<dl class="col-md-3">
					<dt>Ngày Đến: {{$chuyen->gioden}}</dt>
				</dl>
				<dl class="col-md-12">
					<dt>Lộ Trình: &nbsp &nbsp{{$chuyen->noidi}}--{{$chuyen->tentinhdi}}  <i style="padding: 0px 20px;" class="fas fa-arrow-right"></i>  {{$chuyen->noiden}}--{{$chuyen->tentinhden}}</dt>
				</dl>
				<div class="col-3">
					
				</div>
				<dl class="col-md-6">
					<dt>Giá vé: {{$chuyen->giave}} VNĐ</dt>
				</dl>
				@for($i=1 ; $i<=$xe->sotang ; $i++)
					<div class="col-md-4">
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
				<form action="{{route('datve')}}" method="post">
					@csrf
					<input type="hidden" name="idChuyen" value="{{$chuyen->id}}">
					<input id="soghe" type="hidden" name="soghe">
					<button type="submit" class="btn btn-primary btn-md">Đặt vé</button>
				</form>
@endsection

@section('style')
<style type="text/css">
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
		background: #d39e00;
		color: #000;
	}
	.choose{
		background: #007bff;
		color: #fff;
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
		})
	})
</script>
@endsection