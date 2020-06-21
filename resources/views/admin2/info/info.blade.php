@extends('admin2.master.header')

@section('content-title')
	Thông tin tài khoản
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="#">Home</a></li>
	<li class="breadcrumb-item">Tài khoản</li>
	<li class="breadcrumb-item active">Thông tin</li>
@endsection

@section('noidung')
<section class="content">
	<div class="container-fluid">
		<!-- SELECT2 EXAMPLE -->
		<div class="card card-secondary">
			<div class="card-header">
				<h3 class="card-title">Thông tin tài khoản</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<form action="{{route('changeInfoAdmin')}}" method="post">
					@csrf
					<div class="form-group">
						<label for="id">Id:</label>
						<input type="text" value="{{Auth::user()->id}}" disabled="true" class="form-control">
					</div>
					<div class="form-group">
						<label for="email">Email:</label>
						<input type="text" id="email" name="email" value="{{Auth::user()->email}}" disabled="true" class="form-control">
					</div>
					<div class="form-group">
						<label for="sdt">Tên người dùng:</label>
						<input type="text" id="name" name="name" value="{{Auth::user()->name}}" class="form-control">
					</div>
					<div class="form-group">
						<label for="sdt">Số điện thoại:</label>
						<input type="text" id="sdt" name="phone" value="{{Auth::user()->phone}}" class="form-control">
					</div>
					<div class="form-group">
						<label for="diachi">Địa chỉ:</label>
						<input type="text" id="sdt" name="address" value="{{Auth::user()->address}}" class="form-control">
					</div>
					<div class="form-group">
						<label for="diachi">Ngày sinh:</label>
						<input type="date" id="ngaysinh" name="birthday" value="{{Auth::user()->birthday}}" class="form-control">
					</div>
					<div class="form-group">
						<label style="margin-right: 30px;">Giới tính:</label>
						<div class="custom-control custom-radio custom-control-inline" id="gioitinh">
							<input type="radio" class="custom-control-input" id="customRadio1" name="gender" value="1" @if(Auth::user()->gender == 1) checked @endif>
							<label class="custom-control-label" for="customRadio1" style="padding-top: 5px">Nam</label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input type="radio" class="custom-control-input" id="customRadio2" name="gender" value="0" @if(Auth::user()->gender == 0) checked @endif>
							<label class="custom-control-label" for="customRadio2" style="padding-top: 5px">Nữ</label>
						</div>
					</div>
					<div class="submit">
						<button type="submit" class="btn btn-primary" style="width: 150px;">Lưu</button>
					</div>
				</form>
				<!-- /.row -->
			</div>
			<!-- /.card-body -->
			<div class="card-footer">
				Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
				the plugin.
			</div>
		</div>
		<!-- /.card -->

		<!-- SELECT2 EXAMPLE -->
	<!-- /.row -->
</div><!-- /.container-fluid -->
</section>
@endsection

@section('style')
@include('admin2.master.formstyle')
<style type="text/css">
	.toast{
		width: 350px !important;
	}
</style>
@endsection

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

@section('script')
@include('admin2.master.formscript')
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