@extends('user.master.header')

@section('noidung')
	<section>
		<div class="container">
			<div class="row" style="margin: 0px;">
				<div class="form-search">
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
				<div class="slide-main">
					<div id="demo" class="carousel slide" data-ride="carousel">

						<!-- Indicators -->
						<ul class="carousel-indicators">
							<li data-target="#demo" data-slide-to="0" class="active"></li>
							<li data-target="#demo" data-slide-to="1"></li>
							<li data-target="#demo" data-slide-to="2"></li>
						</ul>

						<!-- The slideshow -->
						<div class="carousel-inner">
							<div class="carousel-item active">
								<img src="https://futabus.vn/uploads/useravatar/TCBC%20Tri%20%C3%A2n%20Ba%CC%81c%20Ta%CC%80i%202020%20-web-01.png" alt="Los Angeles">
							</div>
							<div class="carousel-item">
								<img src="https://futabus.vn/uploads/useravatar/TCBC%20Tri%20%C3%A2n%20Ba%CC%81c%20Ta%CC%80i%202020%20-web-01.png" alt="Chicago">
							</div>
							<div class="carousel-item">
								<img src="https://futabus.vn/uploads/useravatar/TCBC%20Tri%20%C3%A2n%20Ba%CC%81c%20Ta%CC%80i%202020%20-web-01.png" alt="New York">
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
			<div class="tuyenxe">
				<h3><i class="fas fa-bus"></i>&nbsp Tuyến: {{$tuyen->tentuyen}}</h3>
				@if(count($chuyen)==0)
				<h5 style="padding: 50px 0px;">Không có chuyến xe phù hợp</h5>
				@else
				<div class="table-responsive-md">
					<table class="table">
						<thead>
							<tr>
								<th>Nơi đi</th>
								<th>Nơi đến</th>
								<th>Giờ đi</th>
								<th>Giờ đến</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($chuyen as $list)
							<tr>
								<td>{{$list->noidi}}</td>
								<td>{{$list->noiden}}</td>
								<td>{{$list->giodi}}</td>
								<td>{{$list->gioden}}</td>
								<td><a href="{{route('chitiet',['id'=>$list->id])}}"><button class="btn btn-success btn-date" data-id='{{$list->id}}' data-name="{{$list->tentuyen}}">Đặt vé</button></a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				@endif
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
