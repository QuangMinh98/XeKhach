@extends('user.master.header')

@section('title')
Thông tin hướng dẫn
@endsection

@section('noidung')
	<section>
		<div class="container">
			<div class="row" style="margin: 0px;">
				<img src="https://futabus.vn/Content/res/head-news.jpg" width="100%" style="padding: 40px 0px">
				<div class="col-md-8 boder">
					<div class="top-title">
						<h4>Hướng Dẫn</h4>
					</div>
					<div class="list-new">
						<table class="table">
							<tbody>
								@foreach($huongdan as $list)
								<tr>
									<td>
										<a href="{{route('viewThongTin',['tieude'=>$list->tenkhongdau.'-'.$list->id])}}"><h5><i class="fas fa-caret-right"></i> {{$list->tieude}}</h5></a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-search">
						<div class="col-md-5">
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
				</div>
			</div>
		</div>
	</section>
@endsection

@section('style')
<style type="text/css">
	.boder{
		margin: 40px 0px;
		border: 1px solid #ddd;
	}
</style>
@endsection