@extends('admin.master.master')

@section('noidung')
<section>
	<div class="breadcrumbs">
		<div class="page-header">
			<h1>Xe Khách</h1>
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
					<form action="{{route('xe')}}" method="GET">
						<div class="form-group">
							<label for="search">Search:</label>
							<input type="search" name="search" id="search" class="form-control">
						</div>
					</form>
				</div>	
			</div>
			<div class="col-md-3">
				<form action="{{route('xe')}}" method="GET">
					<div class="form-group">
						<label for="sort">Sort By:</label>
						<select onchange="this.form.submit()" name="sort" class="form-control">
							<option value="1" @if(isset($sort) and $sort==1)selected @endif>A->Z</option>
							<option value="2" @if(isset($sort) and $sort==2)selected @endif>Z->A</option>
							<option value="3" @if(isset($sort) and $sort==3)selected @endif>Ngày Thêm Tăng Dần</option>
							<option value="4" @if(isset($sort) and $sort==4)selected @endif>Ngày Thêm Giảm Dần</option>
						</select>
					</div>
				</form>
			</div>
			<div class="col-md-4">
				<a href="{{route('showaddxe')}}"><button id="add" class="btn btn-primary btn-md" style="margin-top: 30px; width: auto; ">Thêm Xe</button></a>
			</div>
		</div>
		<div style="overflow: auto;">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>id</th>
						<th>Tên Xe</th>
						<th>Hãng Xe</th>
						<th>Tuyến Xe</th>
						<th>Số Tầng</th>
						<th>Số Ghế</th>
						<th>Biển Số</th>
						<th>Tình Trạng</th>
						<th>Chi Tiết</th>
						<th>Thao Tác</th>
					</tr>
				</thead>
				<tbody>
					@foreach($xe as $ds)
					<tr>
						<td>{{$ds->idXe}}</td>
						<td>{{$ds->tenxe}}</td>
						<td>{{$ds->tenhang}}</td>
						<td>{{$ds->tentuyen}}</td>
						<td>{{$ds->sotang}}</td>
						<td>{{$ds->soghe}}</td>
						<td>{{$ds->biensoxe}}</td>
						@if($ds->tinhtrang == 'Hoạt Động')
						<td><span class="badge badge-primary">{{$ds->tinhtrang}}</span></td>
						@else
						<td><span class="badge badge-danger">{{$ds->tinhtrang}}</span></td>
						@endif
						<td><a href="{{route('detailxe',['id'=>$ds->idXe])}}" class="badge badge-info">Chi Tiết</a></td>
						<td><a class="badge badge-success" href="{{route('showeditxe',['id'=>$ds->idXe])}}">Edit</a> <a class="badge badge-warning del" data-id="{{$ds->idXe}}" href="javascript:">Delete</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</section>
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		$(".del").click(function(){
			id = $(this).data('id');
			if (confirm("Dữ liệu xoá sẽ không khôi phục được. Bạn có thật sự muốn xoá?")) {
				$.post('{{route('delXe')}}',{id:id,_token:"{{csrf_token()}}"}).done(function(){
					location.reload();
				}).fail(function(){
					alert('Không thể hoàn thành thao tác này');
				})
			}
		})
	})
</script>
@endsection