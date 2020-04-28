@extends('teamplate.master.header')

@section('noidung')
	<div class="data">
		<div class="data-title">
			<h4>Thêm Hãng Xe</h4>
		</div>
		<div class="data-form">
			<form action="{{route('addhang')}}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="form-row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="name">Tên Hãng</label>
							<input type="text" class="form-control" id="name" placeholder="Nhập Tên Hãng" name="name">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label id="diachi">Địa Chỉ</label>
							<input type="text" class="form-control" id="diachi" placeholder="Nhập vào địa chỉ" name="diachi">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-6">
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
							<textarea name="mota" class="form-control" style="height: 200px;"></textarea>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-2 col-6">
						<button type="submit" class="btn btn-success" style="width: 100%">Thêm</button>
					</div>
					<div class="col-md-2 col-6">
						<a href="{{route('hang')}}"><button class="btn btn-danger" style="width: 100%">Hủy</button></a>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection

