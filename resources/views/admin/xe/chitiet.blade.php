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
				<input type="hidden" name="id" id="id" value="{{$xe->id}}">
				<dl class="col-md-3">
					<dt>Tên Xe: {{$xe->tenxe}}</dt>
				</dl>
				<dl class="col-md-9">
					<dt>Biển Số Xe: {{$xe->biensoxe}}</dt>
				</dl>
				<dl class="col-md-3">
					<dt>Tên Hãng: {{$hang->tenhang}}</dt>
				</dl>
				<dl class="col-md-3">
					<img style="max-width: 100%;" src="{{asset($hang->img)}}">
				</dl>
				<dl class="col-md-12">
					<dt>Tuyến Xe: {{$tuyen->tentuyen}}</dt>
				</dl>
				<dl class="col-md-3">
					<dt>Số Tầng: {{$xe->sotang}}</dt>
				</dl>
				<dl class="col-md-3">
					<dt>Số Ghế: {{$xe->soghe}}</dt>
				</dl>
				<dl class="col-md-6">
					@if($xe->tinhtrang == 'Hoạt Động')
					<dt>Trạng Thái: <span class="badge badge-primary">Hoạt Động</span></dt>
					@else
					<dt>Trạng Thái: <span class="badge badge-danger">Không Hoạt Động</span></dt>
					@endif
				</dl>
				<dl class="col-md-12">
					<dt>Lộ Trình: &nbsp &nbsp{{$lotrinh->noidi}}--{{$lotrinh->tentinhdi}}  <i style="padding: 0px 20px;" class="fas fa-exchange-alt"></i>  {{$lotrinh->noiden}}--{{$lotrinh->tentinhden}}</dt>
				</dl>
				<dl class="col-md-12">
					<dt>Sơ Đồ Ghế:</dt>
					<div class="row">
						<div class="col-md-2 col-12">
							<label for="tang">Tầng:</label>
							<select id="tang" name="tang" class="form-control form-control-sm">
								@for($i = 1 ; $i<=$xe->sotang ; $i++)
								<option value="{{$i}}">Tầng {{$i}}</option>
								@endfor
							</select>
						</div>
						<div class="col-md-2 col-6">
							<label for="from">Số Ghế Bắt Đầu:</label>
							<select id="from" name="from" class="form-control form-control-sm">
								@foreach($ghe as $seat)
								<option value="{{$seat->soghe}}">{{$seat->soghe}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-2 col-6">
							<label for="to">Số Ghế Kết Thúc:</label>
							<select id="to" name="to" class="form-control form-control-sm">
								@foreach($ghe as $seat)
								<option value="{{$seat->soghe}}">{{$seat->soghe}}</option>
								@endforeach
							</select>
						</div>
						<div style="padding-top: 25px;" class="col-md-1 col-4">
							<button id="save" class="btn btn-primary">Lưu</button>
						</div>
					</div>
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
		$('#save').click(function(){
			var id = $('#id').val();
			var tang = $('#tang').val();
			var from = $('#from').val();
			var to = $('#to').val();
			$.ajax({
				url: '{{route('editSeat')}}',
				type: 'get',
				data: {id:id,tang:tang,from:from,to:to},
				success:function(d){
					alert(d);
					location.reload();
				},
				error:function(){
					alert('Không thể hoàn thành thao tác');
				}
			})
		})
	})
</script>
@endsection