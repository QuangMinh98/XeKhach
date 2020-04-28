@extends('teamplate.master.header')

@section('noidung')
	<div class="data">
		<div class="data-title">
			<h4>Thêm Xe</h4>
		</div>
		<div class="data-form">
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
			<form action="{{route('addxe')}}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="form-row">
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
							<label for="idtuyen">Tuyến Xe</label>
							<select name="idtuyen" class="form-control">
								@foreach($tuyen as $t)
								<option value="{{$t->id}}">{{$t->tentuyen}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="idloaixe">Loại Xe</label>
							<select name="idloaixe" class="form-control">
								@foreach($loaixe as $lx)
								<option value="{{$lx->id}}">{{$lx->tenloaixe}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<div class="form-row">
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
				</div>
				<div class="form-row">
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
				</div>
				<div class="form-row">
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
				</div>
				<div class="form-row">
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
				</div>
				<div class="form-row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="mota">Mô Tả:</label>
							<textarea name="mota" class="form-control" style="height: 200px;"></textarea>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-2 col-6">
						<button type="submit" class="btn btn-success" style="width: 100%">Thêm</button>
					</div>
					<div class="col-md-2 col-6">
						<a href="{{route('xe')}}"><button type="button" class="btn btn-danger" style="width: 100%">Hủy</button></a>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection

@section('style')
<style type="text/css">
	.data{
		overflow: auto;
		height: 93%;
	}
</style>
@endsection