@extends('admin.master.master')

@section('noidung')
<section>
	<div class="breadcrumbs">
		<div class="page-header">
			<h1>Danh Sách Chuyến Xe</h1>
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			<strong>Data Table</strong>
		</div>
	</div>
	<div class="data">
		@if(session('thongbao'))
		<div class="alert alert-success">
		  <strong>Success!</strong> {{session('thongbao')}}
		</div>
		@endif	
		@if(count($errors)>0)
		<div class="alert alert-danger">
		  <strong>Danger!</strong>
		 	@foreach($errors->all() as $err)
				{{$err}}</br>
			@endforeach
		</div>
		@endif
		<div class="row form">
			<div class="col-md-3">
				<div class="search">
					<form action="{{route('chuyenxe')}}" method="GET">
						<div class="form-group">
							<label for="search">Search:</label>
							<input type="search" name="search" id="search" class="form-control">
						</div>
					</form>
				</div>	
			</div>
			<div class="col-md-3">
				<form action="{{route('chuyenxe')}}" method="GET">
					<div class="form-group">
						<label for="sort">Sort By:</label>
						<select onchange="this.form.submit()" name="sort" class="form-control">
							<option value="1" @if(isset($sort) and $sort==1)selected @endif>Ngày Đi Giảm Dần</option>
							<option value="2" @if(isset($sort) and $sort==2)selected @endif>Ngày Đi Tăng Dần</option>
						</select>
					</div>
				</form>
			</div>
			<div class="col-md-4">
				<a href="#"><button id="advanced-search" class="btn btn-primary btn-md" style="margin-top: 30px; width: auto; ">Tìm Kiếm Nâng Cao</button></a>
			</div>
		</div>
		<div class="advanced-search">
			<form action="{{route('chuyenxe')}}" method="GET">
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label for="noidi">Nơi Đi:</label>
							<select name="noidi" class="form-control form-control-sm">
								@foreach($tinh as $t)
								<option value="{{$t->id}}">{{$t->tentinh}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="noiden">Nơi Đến:</label>
							<select name="noiden" class="form-control form-control-sm">
								@foreach($tinh as $t)
								<option value="{{$t->id}}">{{$t->tentinh}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="ngaydi">Ngày Đi:</label>
							<input type="date" name="ngaydi" class="form-control form-control-sm">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2 col-6">
						<button type="submit" class="btn btn-primary btn-md btn-add" name="">Tìm Kiếm</button>
					</div>
					<div class="col-md-2 col-6">
						<button type="button" id="cancel" class="btn btn-primary btn-md btn-add" style="background: #dc3545; border-color: #dc3545;">Hủy</button>
					</div>
				</div>
			</form>
		</div>
		<div style="overflow: auto;">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>id</th>
						<th>Tên Xe</th>
						<th>Hãng Xe</th>
						<th>Tuyến Xe</th>
						<th>Giờ Đi</th>
						<th>Giờ Đến</th>
						<th>Nơi Đi</th>
						<th>Nơi Đến</th>
						<th>Tình Trạng</th>
						<th>Chi Tiết</th>
						<th>Thao Tác</th>
					</tr>
				</thead>
				<tbody>
					@foreach($chuyen as $ds)
					<tr>
						<td>{{$ds->id}}</td>
						<td>{{$ds->tenxe}}-{{$ds->biensoxe}}</td>
						<td>{{$ds->tenhang}}</td>
						<td>{{$ds->tentuyen}}</td>
						<td>{{$ds->giodi}}</td>
						<td>{{$ds->gioden}}</td>
						<td>{{$ds->noidi}}-{{$ds->tentinhdi}}</td>
						<td>{{$ds->noiden}}-{{$ds->tentinhden}}</td>
						<td><span class="badge badge-primary">{{$ds->tinhtrang}}</span></td>
						<td><a href="{{route('detailchuyen',['id'=>$ds->id])}}" class="badge badge-info">Chi Tiết</a></td>
						<td><a class="badge badge-success" href="{{route('showeditchuyen',['id'=>$ds->id])}}">Edit</a> <a class="badge badge-warning del" data-id="{{$ds->id}}" href="javascript:">Delete</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</section>
@endsection

@section('style')
<style type="text/css">
	.advanced-search{
		display: none;
		padding-bottom: 20px;
	}
</style>
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		$("#advanced-search").click(function(){
			$(".advanced-search").slideDown();
		})
		$("#cancel").click(function(){
			$(".advanced-search").slideUp();
		})
		$(".del").click(function(){
			id = $(this).data('id');
			if (confirm("Dữ liệu xoá sẽ không khôi phục được. Bạn có thật sự muốn xoá?")) {
				$.post('{{route('delChuyen')}}',{id:id,_token:"{{csrf_token()}}"}).done(function(){
					location.reload();
				}).fail(function(){
					alert('Không thể hoàn thành thao tác này');
				})
			}
		})
	})
</script>
@endsection