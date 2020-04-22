@extends('user.master.header')


@section('noidung')
<section>
	<div class="container" style="padding-top: 20px;">
		<div class="row" style="margin: 0;">
			@include('user.master.sidebar')
			<div class="content">
				<div class="detail row">
					<div class="col-md-8 col-6">
						<h4>Chi tiết vé: #{{$ve->id}}</h4>	
					</div>
					<div class="col-md-4 col-6">
						<h4 class="status">
							@switch($ve->tinhtrang)
							@case (0)
							<span class="order">Đã đặt vé</span>
							@break
							@case (1)
							<span class="order">Đã tiếp nhận</span>
							@break
							@case (2)
							<span class="success">Đã thành công</span>
							@break
							@case (3)
							<span class="cancel">Đã hủy</span>
							@break
							@endswitch
						</h4>
					</div>
				</div>
				<div class="ticket">
					<div class="panel">
						<p class="text-center text-uppercase text-primary">Thông tin khách hàng</p>
						<div class="index">
							<table class="table">
								<tbody>
									<tr>
										<td><p><strong>Tên khách hàng:</strong><span>&nbsp{{$ve->name}}</span></p></td>
									</tr>
									<tr>
										<td><p><strong>Số ghế:</strong><span>&nbsp{{$ve->soghe}}</span></p></td>
									</tr>
									<tr>
										<td>
											<p>
												<strong>Trạng thái:</strong>
												@switch($ve->tinhtrang)
												@case (0)
												<span class="order">Đã đặt vé</span>
												@break
												@case (1)
												<span class="order">Đã tiếp nhận</span>
												@break
												@case (2)
												<span class="success">Đã thành công</span>
												@break
												@case (3)
												<span class="cancel">Đã hủy</span>
												@break
												@endswitch
											</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>					
					<div class="panel">
						<p class="text-center text-uppercase text-primary">Thông tin chuyến xe</p>
						<div class="index">
							<table class="table">
								<tbody>
									<tr>
										<td><p><strong>Tuyến xe:</strong><span>&nbsp{{$ve->tentuyen}}</span></p></td>
									</tr>
									<tr>
										<td><p><strong>Hãng Xe:</strong><span>&nbsp{{$ve->tenhang}}</span></p></td>
									</tr>
									<tr>
										<td><p><strong>Nơi Đi:</strong><span>&nbsp{{$ve->noidi}}</span></p></td>
									</tr>
									<tr>
										<td><p><strong>Nơi Đến:</strong><span>&nbsp{{$ve->noiden}}</span></p></td>
									</tr>
									<tr>
										<td><p><strong>Giờ Đi:</strong><span>&nbsp{{$ve->giodi}}</span></p></td>
									</tr>
									<tr>
										<td><p><strong>Giờ Đến:</strong><span>&nbsp{{$ve->gioden}}</span></p></td>
									</tr>
									<tr>
										<td><a href="{{route('chitiet',['id'=>$ve->idChuyen])}}">Xem thông tin chuyến xe</a></td>
									</tr>
									@if($ve->tinhtrang == 0)
									<tr>
										<td><button class="btn btn-danger" data-toggle="modal" data-target="#myModal">Hủy vé</button></td>
									</tr>
									@endif
								</tbody>
							</table>
						</div>
					</div>
					<div class="modal fade" id="myModal">
						<div class="modal-dialog dialog-confirm">
							<div class="modal-content">

								<!-- Modal Header -->
								<div class="modal-header">
									<div class="icon-box">
										<i class="far fa-times-circle"></i>
									</div>
									<h4 class="modal-title">Bạn có chắc chắn muốn hủy vé ?</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

								<!-- Modal body -->
								<div class="modal-body">
									<p>Thao tác này sẽ không thể khôi phục, bạn có chắc chắn muốn hủy vé ?</p>
								</div>

								<!-- Modal footer -->
								<div class="modal-footer">
									<form action="{{route('cancelTicket')}}" method="post">
										@csrf
										<input type="hidden" name="id" value="{{$ve->id}}">
										<button type="submit" class="btn btn-danger">Hủy vé</button>
										<button type="button" class="btn btn-info" data-dismiss="modal">Quay lại</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="redirect">
						<a href="{{route('ticket')}}"><<<-Quay lại vé của tôi</a>
						</div>
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
	.second-nav{
		margin-top: 50px; 
	}

	.success{
		color: #82CE34;
	}

	.order{
		color: #007bff;
	}

	.cancel{
		color: #dc3545;
	}

	.index{
		font-family: 'Varela Round', sans-serif;
		color: #28a745;
		font-size: 13px;
	}

	.ticket{
		padding: 30px 0px;
	}

	.detail{
		padding-top: 30px; 
		font-family: 'Varela Round', sans-serif;
		color: #566787;
	}

	.detail h4{
		font-size: 23px;
	}

	.redirect{
		padding: 20px 0px;
	}

	.status{
		float: right;
	}

	.vertical-menu{
		width: 25%;
		padding: 45px 0px;
		font-family: 'Varela Round', sans-serif;
		color: #566787;
		font-size: 13px;
		margin-right: 2%;
	}

	.vertical-menu h4{
		font-size: 25px;
	}

	.content{
		width: 73%;
	}

	@media screen and (max-width: 768px) {
		.vertical-menu{
			display: none;
		}

		.content{
			width: 100%;
		}
	}

	.icon-box{
		margin: 0 auto;
		font-size: 100px;
		color: #dc3545;
		text-align: center;
		z-index: 9;
	}

	.modal-title{
		font-family: 'Varela Round', sans-serif;
	}

	.modal-body p{
		font-family: 'Varela Round', sans-serif;
		text-align: center;
		color: #999;
	}

	.modal-header{
		border-bottom: none;
		display: block;
		position: relative;
	}

	.dialog-confirm h4{
		text-align: center;
	    font-size: 24px;
	    margin: 0px 0 -10px
	}

	.modal-header .close{
		position: absolute;
    	top: 0%;
    	right: 2%;
	}

	.modal-footer{
		border: none;
	    text-align: center;
	    border-radius: 5px;
	    font-size: 13px;
	    padding: 10px 15px 25px;
	    display: block;
	}

	.modal-footer button{
		width: 120px;
		text-align: center;
	}

</style>
@endsection
