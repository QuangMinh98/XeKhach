@extends('teamplate.master.header')

@section('noidung')
	<div class="data">
		<div class="data-title">
			<div class="row">
				<div class="col-md-3">
					<form action="{{route('users')}}" method="GET">
						<div class="form-group">
							<label for="search">Search:</label>
							<input type="search" name="search" id="search" class="form-control">
						</div>
					</form>	
				</div>
				<div class="col-md-3">
					<form action="{{route('users')}}" method="GET">
						<div class="form-group">
							<label for="sort">Sort:</label>
							<select class="form-control" name="sort" onchange="this.form.submit()">
								<option value="0" @if(isset($sort) and $sort==0)selected @endif>A->Z</option>
								<option value="1" @if(isset($sort) and $sort==1)selected @endif>Z->A</option>
							</select>
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
						<th>Email</th>
						<th>Tên Người Dùng</th>
						<th>Level</th>
						<th>Thao Tác</th>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $list)
					<tr>
						<td>{{$list->id}}</td>
						<td>{{$list->email}}</td>
						<td>{{$list->name}}</td>
						<td>
							<span class="badge badge-secondary">Khách Hàng</span>
						</td>
						<td>
							<span class="edit" data-email="{{$list->email}}" data-id ="{{$list->id}}" data-name="{{$list->name}}" data-address="{{$list->address}}" data-phone="{{$list->phone}}" data-gender="{{$list->gender}}" data-birthday="{{$list->birthday}}" data-level="{{$list->level}}" data-toggle="modal" data-target="#editModal" >
								<i class="fas fa-pencil-alt"></i>
							</span>
							<span class="delete" data-id = "{{$list->id}}"><i class="fas fa-trash"></i></span>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="modal fade" id="editModal">
			<div class="modal-dialog  modal-dialog-centered">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">Chỉnh Sửa Thông Tin</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">
						<form action="{{route('editUser')}}" method="POST">
							@csrf
							<input type="hidden" name="id" id="edit-id">
							<div class="form-group">
								<label for="name">Email</label>
								<input type="text" name="email" class="form-control" id="edit-email" disabled="true">
							</div>
							<div class="row">
								<div class="col-6 col-md-6">
									<div class="form-group">
										<label for="name">Tên Quản Trị Viên</label>
										<input type="text" name="name" class="form-control" id="edit-name">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="name">Số Điện Thoại</label>
								<input type="text" name="phone" class="form-control" id="edit-phone">
							</div>
							<div class="form-group">
								<label for="address">Địa Chỉ</label>
								<input type="text" name="address" class="form-control" id="edit-address">
							</div>
							<div class="form-group">
								<label for="birthday">Ngày Sinh</label>
								<input type="date" name="birthday" class="form-control" id="edit-birthday">
							</div>
							<div class="form-group">
								<label style="margin-right: 30px;">Giới tính:</label>
								<div class="custom-control custom-radio custom-control-inline" id="gioitinh">
									<input type="radio" class="custom-control-input" id="male" name="gender" value="1">
									<label class="custom-control-label" for="male" style="padding-top: 5px">Nam</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" class="custom-control-input" id="female" name="gender" value="0">
									<label class="custom-control-label" for="female" style="padding-top: 5px">Nữ</label>
								</div>
							</div>
							<div>
								<button type="submit" class="btn btn-success" style="width: 120px;">Sửa</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal" style="width: 120px;">Close</button>
							</div>
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
@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		$(".edit").click(function(){
			id = $(this).data('id');
			email = $(this).data('email')
			name = $(this).data('name');
			level = $(this).data('level');
			address = $(this).data('address');
			phone = $(this).data('phone');
			gender = $(this).data('gender');
			birthday = $(this).data('birthday');
			$('#edit-id').val(id);
			$('#edit-name').val(name);
			$('#edit-email').val(email);
			$('#edit-address').val(address);
			$('#edit-phone').val(phone);
			$('#edit-birthday').val(birthday);
			if(gender == 1){
				$('#male').attr("checked","true");
			}else{
				$('#female').attr("checked","true");	
			}
		})
		$(".delete").click(function(){
			id = $(this).data('id');
			if (confirm("Dữ liệu xoá sẽ không khôi phục được. Bạn có thật sự muốn xoá?")) {
				$.post('{{route('delUser')}}',{id:id,_token:"{{csrf_token()}}"}).done(function(){
					location.reload();
				}).fail(function(){
					alert('Không thể hoàn thành thao tác này');
				})
			}
		})
	})
</script>
@endsection


