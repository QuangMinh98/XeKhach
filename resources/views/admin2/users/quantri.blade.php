@extends('admin2.master.header')

@section('content-title')
	Danh sách quản trị viên
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="#">Home</a></li>
	<li class="breadcrumb-item">Users</li>
	<li class="breadcrumb-item active">Quản trị</li>
@endsection

@section('noidung')
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header" style="padding: 0.25rem 0.5rem; height: 47px;">
						<!-- <h3 class="card-title">DataTable with default features</h3> -->
						<div class="row">
							<div class="col-md-2 col-6">
								<button class="btn btn-default" data-toggle="modal" data-target="#myModal" style="width: 100%;">Thêm dữ liệu</button>
							</div>
							<div class="col-md-2 col-6">
								<form action="{{route('admin')}}" method="GET">
									<div class="form-group">
										<select onchange="this.form.submit()" name="sort" class="form-control">
											<option value="-1" @if(isset($sort) and $sort==0)selected @endif>Tất Cả</option>
											<option value="0" @if(isset($sort) and $sort==0)selected @endif>Quản Trị</option>
											<option value="1" @if(isset($sort) and $sort==1)selected @endif>Quản Lý</option>
										</select>
									</div>
								</form>
							</div>						
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
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
										<span class="badge badge-danger">Quản Trị</span>
										@else
										<span class="badge badge-primary">Quản Lý</span>
										@endif
									</td>
									<td>
										<a href="#" class="btn btn-info btn-circle edit" data-email="{{$list->email}}" data-id ="{{$list->id}}" data-name="{{$list->name}}" data-address="{{$list->address}}" data-phone="{{$list->phone}}" data-gender="{{$list->gender}}" data-birthday="{{$list->birthday}}" data-level="{{$list->level}}" data-toggle="modal" data-target="#editModal" >
											<i class="fas fa-info-circle"></i>
										</a>
										<a href="#" class="btn btn-danger btn-circle delete" data-id = "{{$list->id}}">
											<i class="fas fa-trash"></i>
										</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</div>
	<div class="modal fade" id="myModal">
		<div class="modal-dialog  modal-dialog-centered">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Thêm Quản Trị Viên</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<form action="{{route('addAdmin')}}" method="POST">
						@csrf
						<div class="form-group">
							<label for="name">Email</label>
							<input type="text" name="email" class="form-control">
						</div>
						<div class="form-group">
							<label for="password">Mật Khẩu</label>
							<input type="password" name="password" class="form-control">
						</div>
						<div class="form-group">
							<label for="password2">Nhập Lại Mật Khẩu</label>
							<input type="password" name="password2" class="form-control">
						</div>
						<div class="row">
							<div class="col-6 col-md-6">
								<div class="form-group">
									<label for="name">Tên Quản Trị Viên</label>
									<input type="text" name="name" class="form-control">
								</div>
							</div>
							<div class="col-6 col-md-6">
								<div class="form-group">
									<label for="level">Chức Vụ</label>
									<select name="level" class="form-control">
										<option value="0">Super Admin</option>
										<option value="1">Admin</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="name">Số Điện Thoại</label>
							<input type="text" name="phone" class="form-control">
						</div>
						<div class="form-group">
							<label for="name">Địa Chỉ</label>
							<input type="text" name="address" class="form-control">
						</div>
						<div class="form-group">
							<label for="name">Ngày Sinh</label>
							<input type="date" name="birthday" class="form-control">
						</div>
						<div class="form-group">
							<label style="margin-right: 30px;">Giới tính:</label>
							<div class="custom-control custom-radio custom-control-inline" id="gioitinh">
								<input type="radio" class="custom-control-input" id="customRadio1" name="gender" value="1">
								<label class="custom-control-label" for="customRadio1" style="padding-top: 5px">Nam</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" class="custom-control-input" id="customRadio2" name="gender" value="0">
								<label class="custom-control-label" for="customRadio2" style="padding-top: 5px">Nữ</label>
							</div>
						</div>
						<div>
							<button type="submit" class="btn btn-success" style="width: 120px;">Thêm</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal" style="width: 120px;">Close</button>
						</div>
					</form>
				</div>

				<!-- Modal footer -->
				<div class="modal-footer">

				</div>

			</div>
		</div>
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
					<form action="{{route('editAdmin')}}" method="POST">
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
							<div class="col-6 col-md-6">
								<div class="form-group">
									<label for="level">Chức Vụ</label>
									<select name="level" class="form-control" id="edit-level">
										<option value="0" id="superadmin">Super Admin</option>
										<option value="1" id="admin">Admin</option>
									</select>
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
								<input type="radio" class="custom-control-input" id="male" name="gender1" value="1">
								<label class="custom-control-label" for="male" style="padding-top: 5px">Nam</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" class="custom-control-input" id="female" name="gender1" value="0">
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
	<!-- /.container-fluid -->
</section>
@endsection

@section('style')
@include('admin2.master.datastyle')
<style type="text/css">
	.toast{
		width: 350px !important;
	}
</style>
@endsection

@section('script')
@include('admin2.master.datascript')
<script type="text/javascript">
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
      switch(level){
        case 0: $("#edit-level").html("<option value='0' selected>Super Admin</option><option value='1'>Admin</option>");
        break;
        case 1: $("#edit-level").html("<option value='0'>Super Admin</option><option value='1' selected>Admin</option>");
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
</script>
@if(session('thongbao'))
<script type="text/javascript">
	$(document).ready(function(){
		var Toast = Swal.mixin({
	      toast: true,
	      position: 'top-end',
	      showConfirmButton: false,
	      timer: 3000
	    });
		$(document).Toasts('create', {
        class: 'bg-success',
        title: 'Success',
        subtitle: 'Subtitle',
        body: '{{session('thongbao')}}'
      })
	})
</script>
@endif

@if(count($errors)>0)
	@foreach($errors->all() as $err)
    <script type="text/javascript">
    	$(document).ready(function(){
		var Toast = Swal.mixin({
	      toast: true,
	      position: 'top-end',
	      showConfirmButton: false,
	      timer: 3000
	    });
		$(document).Toasts('create', {
        class: 'bg-danger',
        title: 'Fail',
        subtitle: 'Subtitle',
        body: '{{$err}}'
      })
	})
    </script>
    @endforeach
@endif 
@endsection