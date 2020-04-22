@extends('admin.master.master')

@section('noidung')
<section>
	<div class="breadcrumbs">
		<div class="page-header">
			<h1>Thêm Hãng Xe</h1>
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			<strong>Data Form</strong>
		</div>
	</div>
	<div class="data">
		@if(count($errors)>0)
		<div class="alert alert-danger">
		  <strong>Danger!</strong>
		 	@foreach($errors->all() as $err)
				{{$err}}</br>
			@endforeach
		</div>
		@endif
		<h3>Thêm hãng xe mới</h5>
		<form action="{{route('addhang')}}" method="POST" enctype="multipart/form-data" >
			@csrf
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="name">Tên Hãng</label>
						<input type="text" name="name" class="form-control">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="diachi">Địa Chỉ:</label>
						<input type="text" name="diachi" class="form-control">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="email">Email:</label>
						<input type="text" name="email" class="form-control">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="phone">Điện Thoại:</label>
						<input type="text" name="phone" class="form-control">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="upload">Ảnh:</label>
						<input type="file" name="upload" class="form-control">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="mota">Mô Tả:</label>
						<textarea name="mota" class="form-control"></textarea>
					</div>
				</div>
				<div class="col-md-2 col-6">
					<button type="submit" class="btn btn-primary btn-md btn-add" name="">Thêm</button>
				</div>
				<div class="col-md-2 col-6">
					<button type="button" id="cancel" class="btn btn-primary btn-md btn-add" style="background: #dc3545; border-color: #dc3545;">Hủy</button>
				</div>
			</div>
		</form>
	</div>
</section>

@endsection

@section('style')
<style type="text/css">
	.data{
		padding-top: 25px; 
	}
	form{
		margin-top: 50px;
		padding: 15px;
	}
</style>
@endsection