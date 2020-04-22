@extends('admin.master.master')

@section('noidung')
<section>
	<div class="breadcrumbs">
		<div class="page-header">
			<h1>Hãng Xe</h1>
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
					<form action="{{route('hang')}}" method="GET">
						<div class="form-group">
							<label for="search">Search:</label>
							<input type="search" name="search" id="search" class="form-control">
						</div>
					</form>
				</div>	
			</div>
			<div class="col-md-3">
				<form action="{{route('hang')}}" method="GET">
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
				<a href="{{route('showAdd')}}"><button id="add" class="btn btn-primary btn-md" style="margin-top: 30px; width: auto; ">Thêm Hãng Xe</button></a>
			</div>
		</div>
		<div style="overflow: auto;">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>id</th>
						<th>Tên Hãng</th>
						<th>Ảnh</th>
						<th>Địa Chỉ</th>
						<th>Điện Thoại</th>
						<th>Email</th>
						<th>Ngày Tạo</th>
						<th>Thao Tác</th>
					</tr>
				</thead>
				<tbody>
					@foreach($hang as $ds)
					<tr>
						<td>{{$ds->id}}</td>
						<td>{{$ds->tenhang}}</td>
						<td><img style="max-width: 100px;" src="{{asset($ds->img)}}"></td>
						<td>{{$ds->diachi}}</td>
						<td>{{$ds->dienthoai}}</td>
						<td>{{$ds->email}}</td>
						<td>{{$ds->created_at}}</td>
						<td><a href="{{route('showEdit',['id'=>$ds->id])}}">Edit</a> <a class="del" data-id="{{$ds->id}}" href="javascript:">Delete</a></td>
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
			if (confirm("Dữ liệu xoá sẽ không khôi phục được. Bạn có thật sự muốn xoá?")) {
		        var del = $(this).data('id');
		        window.location = "delete/"+del;
		      }
		})
	})
</script>
@endsection