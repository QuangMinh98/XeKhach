@extends('admin.master.master')

@section('noidung')
<section>
	<div class="breadcrumbs">
		<div class="page-header">
			<h1>Chỉnh sửa thông tin xe</h1>
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
		<form action="{{route('editxe')}}" method="POST" enctype="multipart/form-data" >
			@csrf
			<input type="hidden" name="id" value="{{$xe->id}}">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="idhang">Hãng Xe</label>
						<select name="idhang" class="form-control">
							@foreach($hangxe as $hx)
								@if($hx->id == $xe->idHang)
								<option value="{{$hx->id}}" selected>{{$hx->tenhang}}</option>
								@else
								<option value="{{$hx->id}}">{{$hx->tenhang}}</option>
								@endif
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="idtuyen">Tuyến Xe Chạy:</label>
						<select name="idtuyen" class="form-control">
							@foreach($tuyen as $t)
								@if($t->id == $xe->idTuyen)
								<option value="{{$t->id}}" selected>{{$t->tentuyen}}</option>
								@else
								<option value="{{$t->id}}">{{$t->tentuyen}}</option>
								@endif
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="idloaixe">Loại Xe:</label>
						<select name="idloaixe" class="form-control">
							@foreach($loaixe as $lx)
								@if($lx->id == $xe->idLoaiXe)
								<option value="{{$lx->id}}" selected>{{$lx->tenloaixe}}</option>
								@else
								<option value="{{$lx->id}}">{{$lx->tenloaixe}}</option>
								@endif
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="name">Tên Xe:</label>
						<input type="text" name="name" class="form-control" value="{{$xe->tenxe}}">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="mauxe">Mẫu Xe:</label>
						<input type="text" name="mauxe" class="form-control" value="{{$xe->mauxe}}">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="bienso">Biển Số Xe</label>
						<input type="text" name="bienso" class="form-control" value="{{$xe->biensoxe}}">
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
						<input type="number" name="sotang" class="form-control" min="1" max="4" value="{{$xe->sotang}}">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="soghe">Số Ghế</label>
						<input type="number" name="soghe" class="form-control" min="5" value="{{$xe->soghe}}">
					</div>
				</div>
				<div class="col-md-4">
					<input type="hidden" name="lotrinhdi" value="{{$lotrinhdi->id}}">
					<div class="form-group">
						<label for="tinhdi">Tỉnh thành đi</label>
						<select name="tinhdi" class="form-control">
							@foreach($tinh as $tinhdi)
								@if($lotrinhdi->idTinhDi == $tinhdi->id)
								 <option value="{{$tinhdi->id}}" selected="">{{$tinhdi->tentinh}}</option>
								@else
								<option value="{{$tinhdi->id}}">{{$tinhdi->tentinh}}</option>
								@endif
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="noidi">Địa điểm đi:</label>
						<input type="text" name="noidi" class="form-control" value="{{$lotrinhdi->noidi}}">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="khoangcach">Khoảng Cách (Kilomete):</label>
						<input type="number" name="khoangcach" class="form-control" value="{{$lotrinhdi->khoangcach}}">
					</div>
				</div>
				<div class="col-md-4">
					<input type="hidden" name="lotrinhve" value="{{$lotrinhve->id}}">
					<div class="form-group">
						<label for="tinhden">Tỉnh thành đến:</label>
						<select name="tinhden" class="form-control">
							@foreach($tinh as $tinhden)
								@if($lotrinhdi->idTinhDen == $tinhden->id)
								 <option value="{{$tinhden->id}}" selected="">{{$tinhden->tentinh}}</option>
								@else
								<option value="{{$tinhden->id}}">{{$tinhden->tentinh}}</option>
								@endif
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="noiden">Địa điểm đến:</label>
						<input type="text" name="noiden" class="form-control" value="{{$lotrinhdi->noiden}}">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="mota">Mô Tả:</label>
						<textarea name="mota" class="form-control">{{$xe->mota}}</textarea>
					</div>
				</div>
				<div class="col-md-2 col-6">
					<button type="submit" class="btn btn-primary btn-md btn-add" name="">Chỉnh Sửa</button>
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