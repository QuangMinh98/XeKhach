@extends('admin2.master.header')

@section('content-title')
	Đổi mật khẩu
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="#">Home</a></li>
	<li class="breadcrumb-item">Tài khoản</li>
	<li class="breadcrumb-item active">Đổi mật khẩu</li>
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
				<form action="{{route('changePasswordAdmin')}}" method="post">
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
						<label for="sdt">Nhập mật khẩu cũ:</label>
						<input type="password" name="password" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="sdt">Nhập mật khẩu mới:</label>
						<input type="password" name="newpass" class="form-control">
					</div>
					<div class="form-group">
						<label for="sdt">Nhập lại mật khẩu mới:</label>
						<input type="password" name="newpass2" class="form-control">
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

@section('script')
@include('admin2.master.formscript')

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

@if(session('status'))
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
        body: '{{session('status')}}'
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