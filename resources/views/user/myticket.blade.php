@extends('user.master.header')


@section('noidung')
<section>
	<div class="container" style="padding-top: 20px; margin-bottom: 100px;">
		<div class="row" style="margin: 0;">
			@include('user.master.sidebar')
			<div class="content">
				<div class="second-nav">
					<ul class="nav nav-tabs">
						<li class="nav-item">
							<a class="nav-link @if($nav == 0) active @endif order" href="{{route('ticket')}}">Vé đã đặt</a>
						</li>
						<li class="nav-item">
							<a class="nav-link  @if($nav == 2) active @endif success" href="{{route('successticket')}}">Vé đã thành công</a>
						</li>
						<li class="nav-item">
							<a class="nav-link  @if($nav == 3) active @endif cancel" href="{{route('cancel')}}">Vé đã hủy</a>
						</li>
					</ul>
				</div>
				<div class="ticket-list">
					@if($ve->count()>0)
					<table class="table">
						<tbody>
							@foreach($ve as $list)
							<tr>
								<td>
									<div class="row">
										<!--<div class="id col-md-2">
											<h4>Mã vé: {{$list->id}}</h4>
										</div>-->
										<div class="name col-md-8 col-8">
											<h4>Tuyến: {{$list->tentuyen}}</h4>
										</div>
										<div class="seat col-md-4 col-4" style="text-align: right;">
											<h4>Số ghế: {{$list->soghe}}</h4>
											<!--<h4>Ngày đặt: {{date('h:i d-m-yy ',strtotime($list->created_at)+7*60*60)}}</h4>-->
										</div>
									</div>
									<div class="seat">
										<h4>{{$list->noidi.'->'.$list->noiden}}</h4>
									</div>
									<div class="seat">
										<h4>Giờ đi: {{$list->giodi}}</h4>
									</div>
									<div class="seat">
										<h4>Giờ đến: {{$list->gioden}}</h4>
									</div>
									<div class="status">
										<h4>Trạng thái: 
											@switch($list->tinhtrang)
											@case (0):
											<span class="order">Đã đặt vé</span>
											@break
											@case (1):
											<span class="order">Đã tiếp nhận</span>
											@break
											@case (2):
											<span class="success">Đã thành công</span>
											@break
											@case (3):
											<span class="cancel">Đã hủy</span>
											@break
											@endswitch
										</h4>
									</div>
									<div class="row">
										<div class="col-md-8 col-8 time">
											<h4>Ngày đặt: {{date('G:i d-m-yy ',strtotime($list->created_at)+7*60*60)}}</h4>
											</div>
										<div class="col-md-4 col-4" style="text-align: right;">
											<a style="float: right;" href="{{route('ticketById',['id'=>$list->id])}}">Xem chi tiết</a>
										</div>
									</div>		
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@else
					<div>
						<h4>Chưa có vé</h4>
					</div>
					@endif
				</div>
				<div class="pagi">
					{{$ve->links()}}
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

@section('style')
<style type="text/css">
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

	.status h4{
		color: #566787;
		font-size: 13px;
		margin-bottom: 10px;
	}

	.ticket-list{
		width: 100%;
		padding: 20px 0px;
		font-family: 'Varela Round', sans-serif;
		color: #28a745;
		font-size: 13px;
	}

	.seat h4{
		color: #566787;
		font-size: 13px;
		margin-bottom: 10px;
	}

	.name h4{
		font-size: 13px;		
		font-weight: bold;
	}

	.hang h4{
		color: #28a745;
		font-size: 13px;
		font-weight: bold;
	}

	.place h4{
		color: #566787;
		font-size: 13px;
	}

	.time h4{
		color: #566787;
		font-size: 13px;
	}

	.id h4{
		color: #566787;
		font-size: 13px;
	}

	.page-link{
		color: #28a745;
		border: none; 
		margin-left: 1px; 
	}

	.page-item.active .page-link {
		background-color: #28a745;
		border-radius: 50% 
	}

	.vertical-menu{
		width: 25%;
		padding: 45px 0px;
		font-family: 'Varela Round', sans-serif;
		color: #566787;
		margin-right: 2%;
		font-size: 13px;
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

</style>
@endsection
