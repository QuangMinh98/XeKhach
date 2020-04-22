@extends('admin.master.master')

@section('noidung')
<section>
	<div class="breadcrumbs">
		<div class="page-header">
			<h1>Chi Tiết Xe</h1>
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			<strong>Data Form</strong>
		</div>
	</div>
	<div class="data">
		@if(count($errors)>0)
		<div class="alert alert-danger">
		  <strong>Danger!</strong>
		 	@foreach($errors->all() as $err)
				{{$err}}</br>
			@endforeach
		</div>
		@endif
		<div class="detail">
			<dl class="row">
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
				<dl class="col-md-3">
					<dt>Trạng Thái: </dt>
					<select id="status" class="form-control form-control-sm">
						<option value="0" @if($chuyen->tinhtrang == 0) selected  @endif>Sẵn Sàng</option>
						<option value="1" @if($chuyen->tinhtrang == 1) selected  @endif>Đang di chuyển</option>
						<option value="2" @if($chuyen->tinhtrang == 2) selected  @endif>Đã hoàn thành</option>
					</select>
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
									<span class="seat">{{$seat->soghe}}</span>
								</div>
								@endif
							@endforeach
						</div>
					</div>
				@endfor
			</div>
		</div>
	</div>
</section>
@endsection

@section('style')
<style type="text/css">
	.data{
		height: auto;
	}

	.detail{
		padding: 40px 25px;
	}

	dt{
		padding: 15px 0px;
	}

	.seat{
		height: 28px;
		width: 35px;
		color: #999;
		cursor: pointer;
		border: 1px solid #424242;
		border-radius: 3px;
		padding: 5px 10px;
		background: #2b2b2b;
		margin: 2px 4px 2px 2px;
		display: inline-block;
		font-weight: 700;
		font-size: 11px;
		text-align: center;
	}
</style>
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		$('#status').change(function(){
			id = $('#id').val();
			status = $('#status').val();
			$.ajax({
				url: '{{route('changeStatus')}}',
				type: 'get',
				data: {id:id,status:status},
				error:function(){
					alert('Không thể hoàn thành thao tác');
				}
			})
		})
	})
</script>
@endsection