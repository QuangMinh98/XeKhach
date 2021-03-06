@extends('user.master.header')

@section('title')
Trang chủ
@endsection

@section('noidung')
	<section>
		<div class="container">
			<div class="row" style="margin: 0px;">
				
				<div class="slide-main col-md-12">
					<div id="demo" class="carousel slide" data-ride="carousel">

						<!-- Indicators -->
						<ul class="carousel-indicators">
							<li data-target="#demo" data-slide-to="0" class="active"></li>
							<li data-target="#demo" data-slide-to="1"></li>
							<li data-target="#demo" data-slide-to="2"></li>
						</ul>

						<!-- The slideshow -->
						<div class="carousel-inner" style="height: 420px;">
							<div class="carousel-item active">
								<img src="https://futabus.vn/uploads/useravatar/Khai%20truong%20VP%20B%E1%BB%93ng%20S%C6%A1n-Web-01-01.png" alt="Los Angeles">
							</div>
							<div class="carousel-item">
								<img src="https://futabus.vn/uploads/useravatar/Th%C3%B4ng%20b%C3%A1o%20t%C4%83ng%20C%C3%A0%20Mau,%20N%C4%83m%20C%C4%83n%20-%20S%C3%A0i%20G%C3%B2n-%20Website-01.png" alt="Chicago">
							</div>
							<div class="carousel-item">
								<img src="https://futabus.vn/uploads/useravatar/thong-bao-tang-cuong-dot-3%20(1).png" alt="New York">
							</div>
						</div>

						<!-- Left and right controls -->
						<a class="carousel-control-prev" href="#demo" data-slide="prev">
							<span class="carousel-control-prev-icon"></span>
						</a>
						<a class="carousel-control-next" href="#demo" data-slide="next">
							<span class="carousel-control-next-icon"></span>
						</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-search col-md-4">
					<div class="col-md-10">
						<div class="header-booking">
							<h1>Đặt vé trực tuyến</h1>
						</div>
						<div class="dialog-datve">
							<form action="{{route('search')}}" method="get">
								<div class="row form-group">
									<label class="col-md-4 col-4 label-normal" style="padding-top: 8px;">Nơi Đi:</label>
									<div class="col-md-8 col-8">
										<select name="noidi" class="form-control">
											@foreach($diadiem as $list)
											<option value="{{$list->id}}">{{$list->tentinh}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="row form-group">
									<label class="col-md-4 col-4 label-normal" style="padding-top: 8px;">Nơi Đến:</label>
									<div class="col-md-8 col-8">
										<select name="noiden" class="form-control">
											@foreach($diadiem as $list)
											<option value="{{$list->id}}">{{$list->tentinh}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="row form-group">
									<label class="col-md-4 col-4 label-normal" style="padding-top: 8px;">Ngày Đi:</label>
									<div class="col-md-8 col-8">
										<input type="date" name="ngaydi" class="form-control" required>
									</div>
								</div>
								<button type="submit" class="btn btn-success" style="width: 100%;">Tìm chuyến xe</button>
							</form>
						</div>
					</div>
				</div>		
				<div class="col-md-1">
					
				</div>
				<div class="col-md-7" style="padding: 50px 20px;">
					<div class="contact">
						<div class="describe-part">
							<p>*** Quý hành khách có thể đặt vé qua tổng đài phục vụ <strong>24/24</strong> của chúng tôi
								(kể cả thứ 7 và Chủ Nhật): <strong><a href="tel:1900 6067">1900 6067</a></strong> hoặc mua vé tiện lợi ngay trên chiếc
								điện thoại thông minh của quý vị thông qua <strong>app Quang Minh</strong></p>
						</div>
						<img src="{{asset('img/contact.png')}}" width="100%">
					</div>
				</div>
			</div>
			<div class="tuyenxe">
					<h3><i class="fas fa-bus"></i>&nbsp Các tuyến xe</h3>
					<div style="height: 400px; overflow: auto; padding-top: 10px;">
						<table class="table">
							<thead>
								<tr>
									<th>Tên Tuyến</th>
									<th>Thao Tác</th>
								</tr>
							</thead>
							<tbody>
								@foreach($tuyen as $list)
								<tr>
									<td>{{$list->tentuyen}}</td>
									<td><button class="btn btn-success btn-date" data-id='{{$list->id}}' data-name="{{$list->tentuyen}}" data-toggle="modal" data-target="#myModal">Chọn ngày đi</button></td>
								</tr>
								@endforeach
							</tbody>
						</table>
						<div class="modal fade" id="myModal">
							<div class="modal-dialog">
								<div class="modal-content">

									<!-- Modal Header -->
									<div class="modal-header">
										<h4 class="modal-title"></h4>
										<button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>

									<!-- Modal body -->
									<div class="modal-body">
										<form action="{{route('searchTuyen')}}" method="get">
											<input type="hidden" name="id" id="idTuyen">
											<div class="form-group">
												<label for="date">Ngày Đi:</label>
												<input type="date" name="ngaydi" class="form-control">
											</div>
											<button class="btn btn-success">Tìm chuyến</button>
										</form>
									</div>

									<!-- Modal footer -->
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									</div>

								</div>
							</div>
						</div>

					</div>
			</div>
			<div class="news">
				<h3><i class="far fa-newspaper"></i>&nbsp Tin Mới</h3>
				<div class="row" style="padding: 30px 0px;">
					@if(count($tintuc)>0)
					<div class="col-md-5">
						<div class="first-news">
							<a href="{{route('viewTin',['tieude'=>$tintuc[0]->tenkhongdau.'-'.$tintuc[0]->id])}}"><img src="{{$tintuc[0]->img}}"></a>
							<a href="{{route('viewTin',['tieude'=>$tintuc[0]->tenkhongdau.'-'.$tintuc[0]->id])}}">
								<h4>{{$tintuc[0]->tieude}}</h4>
							</a>
							<span class="time-up">Ngày đăng: {{date('d-m-yy G:i',strtotime($tintuc[0]->created_at)+7*60*60)}}</span>
							<p>{{$tintuc[0]->tomtat}}</p>
						</div>
					</div>
					<div class="col-md-7">
						<div class="list-news">
							<ul>
								@foreach($tintuc as $ds)
									@if($ds->id != $tintuc[0]->id)
								<li class="items-news">
									<a href="{{route('viewTin',['tieude'=>$ds->tenkhongdau.'-'.$ds->id])}}"><h4>{{$ds->tieude}}</h4></a>							
									<span class="time-up">Ngày đăng: {{date('d-m-yy G:i',strtotime($ds->created_at)+7*60*60)}}</span>
									<p>{{$ds->tomtat}}</p>
								</li>
								<hr>
									@endif
								@endforeach
							</ul>
						</div>
					</div>
					@endif
				</div>
			</div>
		</div>
	</section>
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		$('.btn-date').click(function(){
			name = $(this).data('name');
			id = $(this).data('id');
			$('.modal-title').text(name);
			$('#idTuyen').val(id);
		})
	})
</script>
@endsection