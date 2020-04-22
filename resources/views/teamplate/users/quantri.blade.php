@extends('teamplate.master.header')

@section('noidung')
	<div class="data">
		<div class="data-title">
			<div class="row">
				<div class="col-md-3">
					<form action="{{route('tinh')}}" method="GET">
						<div class="form-group">
							<label for="search">Search:</label>
							<input type="search" name="search" id="search" class="form-control">
						</div>
					</form>	
				</div>
				<div class="col-md-3 add">
					<button class="btn btn-success"><i class="fas fa-plus-circle"></i> Thêm Quản Trị Viên</button>
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
						<th>Email</th>
						<th>Tên Người Dùng</th>
						<th>Level</th>
						<th>Thao Tác</th>
					</tr>
				</thead>
				<tbody>
					@foreach($admin as $list)
					<tr>
						<td>{{$list->id}}</td>
						<td>{{$list->email}}</td>
						<td>{{$list->name}}</td>
						<td>
							@if($list->level == 0)
								<span class="badge badge-danger">Super Admin</span>
							@else
								<span class="badge badge-primary">Admin</span>
							@endif
						</td>
						<td><span class="edit" data-id ="{{$list->id}}" data-name="{{$list->tentinh}}"><i class="fas fa-pencil-alt"></i></span><span class="delete" data-id = "{{$list->id}}"><i class="fas fa-trash"></i></span></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection


