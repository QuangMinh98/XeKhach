@extends('teamplate.master.header')

@section('noidung')
	<div class="data">
		<div class="data-title">
			<div class="row">
				<div class="col-md-3">
					<form action="{{route('hang')}}" method="GET">
						<div class="form-group">
							<label for="search">Search:</label>
							<input type="search" name="search" id="search" class="form-control">
						</div>
					</form>	
				</div>
			</div>
		</div>
		<div class="data-table">
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
			<table class="table table-hover">
				<thead class="thead-light">
					<tr>
						<th>id</th>
						<th>Tên Xe</th>
						<th>Hãng Xe</th>
						<th>Tuyến Xe</th>
						<th>Giờ Đi</th>
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
						<td>{{$ds->giodi}}->{{$ds->gioden}}</td>
						<td><a href="{{route('detailchuyen',['id'=>$ds->id])}}" class="badge badge-info">Chi Tiết</a></td>
						<td>
							<a href="{{route('showeditchuyen',['id'=>$ds->id])}}">
								<span class="edit"><i class="fas fa-pencil-alt"></i></span>
							</a>
							<span class="delete" data-id = "{{$ds->idXe}}"><i class="fas fa-trash"></i></span>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection


