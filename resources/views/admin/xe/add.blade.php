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
		<h3>Thêm xe mới</h5>
		<form action="{{route('addxe')}}" method="POST" enctype="multipart/form-data" >
			@csrf
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="idhang">Hãng Xe</label>
						<select name="idhang" class="form-control">
							@foreach($hangxe as $hx)
								<option value="{{$hx->id}}">{{$hx->tenhang}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="idtuyen">Tuyến Xe Chạy:</label>
						<select name="idtuyen" class="form-control">
							@foreach($tuyen as $t)
								<option value="{{$t->id}}">{{$t->tentuyen}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="idloaixe">Loại Xe:</label>
						<select name="idloaixe" class="form-control">
							@foreach($loaixe as $lx)
								<option value="{{$lx->id}}">{{$lx->tenloaixe}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="name">Tên Xe:</label>
						<input type="text" name="name" class="form-control">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="mauxe">Mẫu Xe:</label>
						<input type="text" name="mauxe" class="form-control">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="bienso">Biển Số Xe</label>
						<input type="text" name="bienso" class="form-control">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="upload">Ảnh</label>
						<input type="file" name="upload" class="form-control">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="sotang">Số Tầng</label>
						<input type="number" name="sotang" class="form-control" min="1" max="4">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="soghe">Số Ghế</label>
						<input type="number" name="soghe" class="form-control" min="5">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="tinhdi">Tỉnh thành đi</label>
						<select name="tinhdi" class="form-control">
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
						<select name="tinhden" class="form-control">
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
		height: auto; 
	}
	form{
		margin-top: 50px;
		padding: 15px;
	}
</style>
@endsection