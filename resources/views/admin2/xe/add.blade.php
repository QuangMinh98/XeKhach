@extends('admin2.master.header')

@section('content-title')
	Thêm xe mới
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="#">Home</a></li>
	<li class="breadcrumb-item">Xe</li>
	<li class="breadcrumb-item active">Thêm</li>
@endsection

@section('noidung')
<section class="content">
	<div class="container-fluid">
		<!-- SELECT2 EXAMPLE -->
		<div class="card card-secondary">
			<div class="card-header">
				<h3 class="card-title">Nhập thông tin xe</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<form action="{{route('addxe')}}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Tuyến Xe:</label>
								<select name="idtuyen" class="form-control select2" style="width: 100%;">
									@foreach($tuyen as $t)
									<option value="{{$t->id}}">{{$t->tentuyen}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="idloaixe">Loại Xe:</label>
								<select name="idloaixe" class="form-control select2" style="width: 100%;">
									@foreach($loaixe as $lx)
									<option value="{{$lx->id}}">{{$lx->tenloaixe}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="name">Tên Xe:</label>
								<input type="text" name="name" class="form-control" style="width: 100%;">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="mauxe">Mẫu Xe:</label>
								<input type="text" name="mauxe" class="form-control" style="width: 100%;">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="bienso">Biển Số Xe</label>
								<input type="text" name="bienso" class="form-control" style="width: 100%;">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="upload">Ảnh</label>
								<input type="file" name="upload" class="form-control" style="width: 100%;">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="sotang">Số Tầng</label>
								<input type="number" name="sotang" class="form-control" min="1" max="4" style="width: 100%;">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="soghe">Số Ghế</label>
								<input type="number" name="soghe" class="form-control" min="5" style="width: 100%;">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="tinhdi">Tỉnh thành đi</label>
								<select name="tinhdi" class="form-control select2">
									@foreach($tinh as $tinhdi)
									<option value="{{$tinhdi->id}}">{{$tinhdi->tentinh}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="noidi">Địa điểm đi</label>
								<input type="text" name="noidi" class="form-control">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="khoangcach">Khoảng Cách (Kilomete)</label>
								<input type="number" name="khoangcach" class="form-control">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="tinhden">Tỉnh thành đến</label>
								<select name="tinhden" class="form-control select2">
									@foreach($tinh as $tinhden)
									<option value="{{$tinhden->id}}">{{$tinhden->tentinh}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="noiden">Địa điểm đến</label>
								<input type="text" name="noiden" class="form-control">
							</div>
						</div>
						<div class="col-md-4">
							
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="mota">Mô Tả:</label>
								<textarea name="mota" class="form-control" style="height: 200px;"></textarea>
							</div>
						</div>
						<div class="col-md-2 col-6">
							<button type="submit" class="btn btn-success" style="width: 100%">Thêm</button>
						</div>
						<div class="col-md-2 col-6">
							<a href="{{route('xe')}}"><button type="button" class="btn btn-danger" style="width: 100%">Hủy</button></a>
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