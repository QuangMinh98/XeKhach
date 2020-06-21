@extends('admin2.master.header')

@section('content-title')
	Chi tiết vé xe
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="#">Home</a></li>
	<li class="breadcrumb-item">Vé</li>
	<li class="breadcrumb-item active">Chi tiết</li>
@endsection

@section('noidung')
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4">
				<div class="card card-orange card-outline">
					<div class="card-body box-profile">
						<div class="text-center">
							<img class="profile-user-img img-fluid img-circle"
							src="{{asset('img/user.png')}}"
							alt="User profile picture">
						</div>

						<h3 class="profile-username text-center">{{$user->name}}</h3>

						<p class="text-muted text-center">{{$user->email}}</p>

						<ul class="list-group list-group-unbordered mb-3">
							<li class="list-group-item">
								<b>Điện Thoại:</b> <a class="float-right">{{$user->phone}}</a>
							</li>
							<li class="list-group-item">
								<b>Địa Chỉ:</b> <a class="float-right">{{$user->address}}</a>
							</li>
							<li class="list-group-item">
								<b>Ngày Đặt:</b> <a class="float-right">{{date('l d-m-yy h:i',strtotime($ve->created_at)+7*60*60)}}</a>
							</li>
							<li class="list-group-item">
								<b>Số ghế:</b> <a class="float-right">{{$ve->soghe}}</a>
							</li>
							<li class="list-group-item">
								<b>Thanh Toán:</b> <a class="float-right">
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
								</a>
							</li>
							<li class="list-group-item">
								<b>Tình Trạng:</b> 
								@switch($ve->tinhtrang)
									@case (0)
									<a class="float-right text-primary" id="text-status">Đã Đặt</a>
									@break
									@case (1)
									<a class="float-right text-primary" id="text-status">Đã Tiếp Nhận</a>
									@break
									@case (2)
									<a class="float-right text-success" id="text-status">Đã Hoàn Thành</a>
									@break
									@case (3)
									<a class="float-right text-danger" id="text-status">Đã Hủy</a>
									@break
									@endswitch
							</li>
							<li class="list-group-item">
								<b>Tiếp nhận:</b> <a class="float-right">
									<input  type="checkbox" name="my-checkbox" id="changestatus" data-bootstrap-switch data-off-color="danger" data-on-color="success" data-id="{{$ve->id}}" @if($ve->tinhtrang != 0) checked @endif @if($ve->tinhtrang == 2 || $ve->tinhtrang == 3) disabled @endif>
								</a>
							</li>
						</ul>
						@if($ve->tinhtrang == 0 || $ve->tinhtrang == 1)
						<a href="#" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modal-danger"><b>Hủy vé</b></a>
						<div class="modal fade" id="modal-danger">
							<div class="modal-dialog">
								<div class="modal-content bg-danger">
									<div class="modal-header">
										<h4 class="modal-title">Hủy Vé</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<p>Bạn có chắc chắn muốn hủy vé ?</p>
									</div>
									<div class="modal-footer justify-content-between">
										<button type="button" class="btn btn-outline-light" data-dismiss="modal">Đóng</button>
										<form action="{{route('admin_cancel_ticket')}}" method="post">
											@csrf
											<input type="hidden" name="id" value="{{$ve->id}}">
											<button type="submit" class="btn btn-outline-light">Hủy Vé</button>
										</form>
									</div>
								</div>
								<!-- /.modal-content -->
							</div>
							<!-- /.modal-dialog -->
						</div>
						@endif
					</div>
					<!-- /.card-body -->
				</div>
			</div>
			<div class="col-md-7">
				<div class="card card-orange" style="height: 97.5%;">
					<div class="card-header">
						<h3 class="card-title">Thông tin chuyến xe</h3>
					</div>
					<div class="card-body box-profile" style="padding-top: 80px;">
						<ul class="list-group list-group-unbordered mb-3">
							<li class="list-group-item">
								<b>Mã Chuyến Xe:</b> <a class="float-right">{{$chuyen->id}}</a>
							</li>
							<li class="list-group-item">
								<b>Tuyến Xe:</b> <a class="float-right">{{$tuyen->tentuyen}}</a>
							</li>
							<li class="list-group-item">
								<b>Loại Xe:</b> <a class="float-right">{{$loaixe->tenloaixe}}</a>
							</li>
							<li class="list-group-item">
								<b>Ngày Đi:</b> <a class="float-right">{{$chuyen->giodi}}</a>
							</li>
							<li class="list-group-item">
								<b>Ngày Đến:</b> <a class="float-right">{{$chuyen->gioden}}</a>
							</li>
							<li class="list-group-item">
								<b>Giá Vé:</b> <a class="float-right">{{$chuyen->giave}} VNĐ</a>
							</li>
							<li class="list-group-item">
								<b>Lộ Trình:</b> <a class="float-right">{{$lotrinh->noidi}}-{{$tinhdi->tentinh}}  <i style="padding: 0px 20px;" class="fas fa-arrow-right"></i>  {{$lotrinh->noiden}}-{{$tinhden->tentinh}}</a>
							</li>

						</ul>
					</div>
				</div>
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
</section>
@endsection

@section('style')
@include('admin2.master.formstyle')
<style type="text/css">
	.toast{
		width: 350px !important;
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
@include('admin2.master.formscript')
<script type="text/javascript">
	$('.custom-control-input').click(function(){
		var id = $(this).data('id');
		var thanhtoan =0;
		if($(this).prop('checked')){
			thanhtoan = 1;
		}
		else{
			thanhtoan = 0;    }
			$.ajax({
				url: '{{route('thanhtoan')}}',
				type: 'POST',
				data:{id:id,thanhtoan:thanhtoan,_token:"{{csrf_token()}}"},
				error:function(){
					alert('không thể hoàn thành thao tác')
				}
			})
		})
	$('#changestatus').on('switchChange.bootstrapSwitch', function() {
		id = $(this).data('id');
		status = 0;
		text = "";
		if($(this).prop('checked')){
			status = 1;
			text = "Đã Tiếp Nhận";
		}
		else{
			status = 0;
			text = "Đã Đặt";
		}
		$.ajax({
			url: '{{route('tiepnhan')}}',
			type: 'post',
			data: {id:id,status:status,_token:"{{csrf_token()}}"},
			success:function(){
				$("#text-status").text(text);
			},
			error:function(){
				alert('Không thể hoàn thành thao tác');
			}
		})
	});

</script> 
@endsection