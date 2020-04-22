@extends('admin.master.master')

@section('noidung')
<section>
	<div class="breadcrumbs">
		<div class="page-header">
			<h1>Danh sách quản trị viên</h1>
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
					<form action="" method="GET">
						<div class="form-group">
							<label for="search">Search:</label>
							<input type="search" name="search" id="search" class="form-control">
						</div>
					</form>
				</div>	
			</div>
			<div class="col-md-3">
				<form action="" method="GET">
					<div class="form-group">
						<label for="sort">Sort By:</label>
						<select onchange="this.form.submit()" name="sort" class="form-control">
							<option value="1" @if(isset($sort) and $sort==1)selected @endif>A->Z</option>
							<option value="2" @if(isset($sort) and $sort==2)selected @endif>Z->A</option>
						</select>
					</div>
				</form>
			</div>
			<div class="col-md-4">
				<button id="add" class="btn btn-primary btn-md" style="margin-top: 30px; width: auto; ">Thêm người dùng</button>
			</div>
		</div>
		<div class="form-add">
			<form action="{{route('addUser')}}" method="POST">
				@csrf
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label for="email">Email:</label>
							<input type="text" name="email" class="form-control form-control-sm">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="password">Password:</label>
							<input type="password" name="password" class="form-control form-control-sm">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="name">Username:</label>
							<input type="text" name="name" class="form-control form-control-sm">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2 col-6">
						<button type="submit" class="btn btn-primary btn-md btn-add" name="">Thêm</button>
					</div>
					<div class="col-md-2 col-6">
						<button type="button" id="cancel" class="btn btn-primary btn-md btn-add" style="background: #dc3545; border-color: #dc3545;">Hủy</button>
					</div>
				</div>
			</form>
		</div>
		<div class="form-edit">
			<form action="{{route('editUser')}}" method="POST">
				@csrf
				<input type="hidden" name="id" id="id">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="name">username:</label>
							<input id="editname" type="text" name="name" class="form-control">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2 col-6">
						<button type="submit" class="btn btn-primary btn-md btn-add" name="">Sửa</button>
					</div>
					<div class="col-md-2 col-6">
						<button type="button" id="cancel-edit" class="btn btn-primary btn-md btn-add" style="background: #dc3545; border-color: #dc3545;">Hủy</button>
					</div>
				</div>
			</form>
		</div>
		<div style="overflow: auto;">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>id</th>
						<th>Username</th>
						<th>Email</th>
						<th>Level</th>
						<th>Ngày Tạo</th>
						<th>Thao Tác</th>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $ad)
					<tr>
						<td>{{$ad->id}}</td>
						<td>{{$ad->name}}</td>
						<td>{{$ad->email}}</td>
						<td><span class="badge badge-secondary">Khách Hàng</span></td>
						<td>{{$ad->created_at}}</td>
						<td><a class="edit" data-id="{{$ad->id}}" data-name="{{$ad->name}}" href="javascript:">Edit</a> <a class="del" data-id="{{$ad->id}}" href="javascript:">Delete</a></td>
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
		$("#add").click(function(){
			$(".form-add").slideDown();
		})
		$("#cancel").click(function(){
			$(".form-add").slideUp();
		})
		$(".edit").click(function(){
			$(".form-edit").slideDown();
			var id = $(this).data('id');
			var name = $(this).data('name');
			$("#editname").val(name);
			$("#id").val(id);			
		})
		$("#cancel-edit").click(function(){
			$(".form-edit").slideUp();
		})
		$(".del").click(function(){
			if (confirm("Dữ liệu xoá sẽ không khôi phục được. Bạn có thật sự muốn xoá?")) {
		        var del = $(this).data('id');
		        window.location = "delete/"+del;
		      }
		})
	})
</script>
@endsection
