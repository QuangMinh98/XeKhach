@extends('admin2.master.header')

@section('content-title')
	Chỉnh sửa bài viết
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="#">Home</a></li>
	<li class="breadcrumb-item">Tin tức</li>
	<li class="breadcrumb-item active">Chỉnh sửa</li>
@endsection

@section('noidung')
<section class="content">
	<div class="container-fluid">
		<!-- SELECT2 EXAMPLE -->
		<div class="card card-secondary">
			<div class="card-header">
				<h3 class="card-title">Nhập thông bài viết</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<form action="{{route('editTin')}}" method="post" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="id" value="{{$tintuc->id}}">
					<div class="form-group">
						<label for="tieude">Tiêu Đề</label>
						<input type="text" id="tieude" name="tieude" class="form-control" placeholder="Nhập tiêu đề" value="{{$tintuc->tieude}}">
					</div>
					<div class="form-group">
						<label for="tomtat">Tóm Tắt</label>
						<textarea class="form-control" name="tomtat" style="height: 150px" placeholder="Nhập Vào Tóm Tắt">{{$tintuc->tomtat}}</textarea>
					</div>
					<div class="custom-file mb-3">
						<input type="file" class="custom-file-input" id="customFile" name="upload">
						<label class="custom-file-label" for="customFile">Chọn Ảnh</label>
					</div>
					<div class="form-group">
						<textarea id="noidung" name="noidung">{{$tintuc->noidung}}</textarea>
					</div>
					<div class="form-row">
						<div class="col-md-2 col-6">
							<button type="submit" class="btn btn-success" style="width: 100%">Chỉnh sửa</button>
						</div>
						<div class="col-md-2 col-6">
							<a href="{{route('tintuc')}}"><button type="button" class="btn btn-danger" style="width: 100%">Hủy</button></a>
						</div>
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
<script type="text/javascript">
  // Add the following code if you want the name of the file appear on select
  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
</script>
<script type="text/javascript" src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script>    CKEDITOR.replace( 'noidung' );</script>
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