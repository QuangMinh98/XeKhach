@extends('teamplate.master.header')

@section('noidung')
	<div class="data">
		<div class="data-title">
			<h4>Chi Tiết Vé: #{{$ve->id}}</h4>
		</div>
		<div class="data-form">
			<div class="row">
				<div class="col-md-6">
					<div class="panel">
						<p class="text-center text-uppercase text-primary">Thông tin vé</p>
						<table class="table">
							<tbody>
								<tr>
									<td><p><strong>Tên khách hàng:</strong><span>&nbsp{{$user->name}}</span></p></td>
								</tr>
								<tr>
									<td><p><strong>Số Điện Thoại:</strong><span>&nbsp{{$user->phone}}</span></p></td>
								</tr>
								<tr>
									<td><p><strong>Địa Chỉ:</strong><span>&nbsp{{$user->address}}</span></p></td>
								</tr>
								<tr>
									<td><p><strong>Số ghế:</strong><span>&nbsp{{$ve->soghe}}</span></p></td>
								</tr>
								<tr>
									<td><p><strong>Ngày Đặt:</strong><span>&nbsp {{date('l d-m-yy h:i',strtotime($ve->created_at)+7*60*60)}}</span></p></td>
								</tr>
								<tr>
									<td>
										<p><strong>Thanh Toán:</strong>			
											@if($ve->tinhtrang == 2 || $ve->tinhtrang ==3)
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" data-id="{{$ve->id}}" id="customCheck" name="example1" @if($ve->thanhtoan == 1) checked @endif disabled>
												<label class="custom-control-label" for="customCheck"></label>
											</div>
											@else
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" data-id="{{$ve->id}}" id="customCheck" name="example1" @if($ve->thanhtoan == 1) checked @endif>
												<label class="custom-control-label" for="customCheck"></label>
											</div>
											@endif
										</p>
									</td>
								</tr>
								<tr>
									<td>
										<p>
											<strong>Trạng thái:</strong>
										</p>
										<select class="form-control form-control-sm" id="changestatus">
											<option value="0" @if($ve->tinhtrang ==0) selected @endif>Đã Đặt</option>
											<option value="1" @if($ve->tinhtrang ==1) selected @endif>Đã Tiếp Nhận</option>
											<option value="2" @if($ve->tinhtrang ==2) selected @endif>Hoàn Thành</option>
											<option value="3" @if($ve->tinhtrang ==3) selected @endif>Đã Hủy</option>
										</select>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel">
						<p class="text-center text-uppercase text-primary">Thông tin chuyến xe</p>
						<table class="table">
							<tbody>
								<tr>
									<td><p><strong>Tên Hãng:</strong><span>&nbsp{{$hang->tenhang}}</span></p></td>
								</tr>
								<tr>
									<td><p><strong>Logo:</strong><span>&nbsp <img style="width: 120px;" src="{{asset($hang->img)}}"></span></p></td>
								</tr>
								<tr>
									<td><p><strong>Tuyến Xe:</strong><span>&nbsp{{$tuyen->tentuyen}}</span></p></td>
								</tr>
								<tr>
									<td><p><strong>Mã Chuyến Xe:</strong><span>&nbsp{{$chuyen->id}}</span></p></td>
								</tr>
								<tr>
									<td><p><strong>Ngày Đi:</strong><span>&nbsp{{$chuyen->giodi}}</span></p></td>
								</tr>
								<tr>
									<td><p><strong>Ngày Đến:</strong><span>&nbsp{{$chuyen->gioden}}</span></p></td>
								</tr>
								<tr>
									<td><p><strong>Giá Vé:</strong><span>&nbsp{{$chuyen->giave}} VNĐ</span></p></td>
								</tr>
								<tr>
									<td><p><strong>Lộ Trình:</strong><span>&nbsp{{$lotrinh->noidi}}-{{$tinhdi->tentinh}}  <i style="padding: 0px 20px;" class="fas fa-arrow-right"></i>  {{$lotrinh->noiden}}-{{$tinhden->tentinh}}</span></p></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('style')
<style type="text/css">
	.data{
		overflow-x: hidden;
		height: 93%;
	}
	.table{
		background: unset;
	}
</style>
@endsection

@section('script')
<script type="text/javascript">
	$('.custom-control-input').click(function(){
		var id = $(this).data('id');
		var thanhtoan =0;
		if($(this).prop('checked')){
			thanhtoan = 1;
		}
		else{
			thanhtoan = 0;		}
		$.ajax({
		    url: '{{route('thanhtoan')}}',
		    type: 'POST',
		    data:{id:id,thanhtoan:thanhtoan,_token:"{{csrf_token()}}"},
		    error:function(){
		    	alert('không thể hoàn thành thao tác')
		    }
		})
	})
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
</script>
@endsection
