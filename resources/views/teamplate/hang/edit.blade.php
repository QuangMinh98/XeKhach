@extends('teamplate.master.header')

@section('noidung')
	<div class="data">
		<div class="data-title">
			<h4>Chỉnh Sửa Thông Tin Hãng Xe</h4>
		</div>
		<div class="data-form">
			<form action="{{route('edithang')}}" method="post" enctype="multipart/form-data">
				@csrf
				<input type="hidden" name="id" value="{{$hang->id}}">
				<div class="form-row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="name">Tên Hãng</label>
							<input type="text" class="form-control" id="name" placeholder="Nhập Tên Hãng" name="name" value="{{$hang->tenhang}}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label id="diachi">Địa Chỉ</label>
							<input type="text" class="form-control" id="diachi" placeholder="Nhập vào địa chỉ" name="diachi" value="{{$hang->diachi}}">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="email">Email:</label>
							<input type="text" name="email" class="form-control" value="{{$hang->email}}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="phone">Điện Thoại:</label>
							<input type="text" name="phone" class="form-control" value="{{$hang->dienthoai}}">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="upload">Ảnh:</label>
							<input type="file" name="upload" class="form-control">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="mota">Mô Tả:</label>
							<textarea name="mota" class="form-control" style="height: 200px;">{{$hang->mota}}</textarea>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-2 col-6">
						<button type="submit" class="btn btn-success" style="width: 100%">Chỉnh Sửa</button>
					</div>
					<div class="col-md-2 col-6">
						<a href="{{route('hang')}}"><button type="button" class="btn btn-danger" style="width: 100%">Hủy</button></a>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection

