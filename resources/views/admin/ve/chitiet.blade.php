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
					<dt>Tên Hãng: {{$hang->tenhang}}</dt>
				</dl>
				<dl class="col-md-3">
					<img style="max-width: 100%;" src="{{asset($hang->img)}}">
				</dl>
				<dl class="col-md-12">
					<dt>Tuyến Xe: {{$tuyen->tentuyen}}</dt>
				</dl>
				<dl class="col-md-12">
					<dt>Mã Chuyến Xe: {{$chuyen->id}}</dt>
				</dl>
				<dl class="col-md-3">
					<dt>Ngày Đi: {{$chuyen->giodi}}</dt>
				</dl>
				<dl class="col-md-3">
					<dt>Ngày Đến: {{$chuyen->gioden}}</dt>
				</dl>
				<dl class="col-md-12">
					<dt>Ngày Đặt: {{date('l d-m-yy h:i',strtotime($ve->created_at)+7*60*60)}}</dt>
				</dl>
				<dl class="col-md-12">
					<dt>Số Ghế: {{$ve->soghe}}</dt>
				</dl>
				<dl class="col-md-3">
					<dt>Giá Vé: {{$chuyen->giave}} VNĐ</dt>
				</dl>
				<dl class="col-md-3">
					<dt>Thanh Toán: 
						@if($ve->thanhtoan == 0)
						<span id="thanhtoan"  class="badge badge-warning">Chưa thanh toán</span>
						<input class="check" type="checkbox" name="" value="0">
						@else
						<span id="thanhtoan"  class="badge badge-primary">Đã thanh toán</span>
						<input class="check" type="checkbox" name="" value="1" checked>
						@endif
					</dt>
				</dl>
				<dl class="col-md-3">
					<dt>Trạng Thái:
					@switch($ve->tinhtrang)
						@case (0)
							<span id="status" class="badge badge-primary" href="">Đã Đặt</span>
						@break
						@case (1)
							<span id="status" class="badge badge-info" href="">Đã Tiếp Nhận</span>
						@break
						@case (2)
							<span id="status" class="badge badge-success">Đã Hoàn Thành</span>
						@break
						@case (3)
							<span id="status" class="badge badge-danger">Đã Hủy</span>
						@break 
					@endswitch					
					</dt>
					<select class="form-control form-control-sm" id="changestatus">
						<option value="0" @if($ve->tinhtrang ==0) selected @endif>Đã Đặt</option>
						<option value="1" @if($ve->tinhtrang ==1) selected @endif>Đã Tiếp Nhận</option>
						<option value="2" @if($ve->tinhtrang ==2) selected @endif>Hoàn Thành</option>
						<option value="3" @if($ve->tinhtrang ==3) selected @endif>Đã Hủy</option>
					</select>
				</dl>
				<dl class="col-md-12">
					<dt>Lộ Trình: &nbsp &nbsp{{$lotrinh->noidi}}--{{$tinhdi->tentinh}}  <i style="padding: 0px 20px;" class="fas fa-arrow-right"></i>  {{$lotrinh->noiden}}--{{$tinhden->tentinh}}</dt>
				</dl>			
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
		$('#changestatus').change(function(){
			id = {{$ve->id}};
			status = $('#changestatus').val();
			switch($('#changestatus').val()){
				case '0': $('#status').removeClass('badge-info badge-success badge-danger badge-primary').addClass('badge-primary').html('Đã Đặt');
				break;
				case '1': $('#status').removeClass('badge-info badge-success badge-danger badge-primary').addClass('badge-info').html('Đã Tiếp Nhận');
				break;
				case '2': $('#status').removeClass('badge-info badge-success badge-danger badge-primary').addClass('badge-success').html('Đã Hoàn Thành');
				break;
				case '3': $('#status').removeClass('badge-info badge-success badge-danger badge-primary').addClass('badge-danger').html('Đã Hủy');
				break;
			};
			$.ajax({
				url: '{{route('tiepnhan')}}',
				type: 'post',
				data: {id:id,status:status,_token:"{{csrf_token()}}"},
				error:function(){
					alert('Không thể hoàn thành thao tác');
				}
			})
		})
		$('.check').click(function(){
			var id = {{$ve->id}};
			var thanhtoan =0;
			if($(this).prop('checked')){
				thanhtoan = 1;
				$('#thanhtoan').html('Đã thanh toán').removeClass('badge-warning').addClass('badge-primary');
			}
			else{
				thanhtoan = 0;
				$('#thanhtoan').html('Chưa thanh toán').removeClass('badge-primary').addClass('badge-warning');
			}
			$.ajax({
			    url: '{{route('thanhtoan')}}',
			    type: 'POST',
			    data:{id:id,thanhtoan:thanhtoan,_token:"{{csrf_token()}}"},
			    error:function(){
			    	alert('không thể hoàn thành thao tác')
			    }
			})
		})
	})
</script>
@endsection