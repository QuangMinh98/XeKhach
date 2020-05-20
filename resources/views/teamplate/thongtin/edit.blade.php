@extends('teamplate.master.header')

@section('noidung')
	<div class="data">
		<div class="data-title">
			<h4>Thêm Tin Tức</h4>
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
			<form action="{{route('editThongTin')}}" method="post">
				@csrf
				<input type="hidden" name="id" value="{{$thongtin->id}}">
				<div class="form-group">
					<label for="tieude">Tiêu Đề</label>
					<input type="text" id="tieude" name="tieude" class="form-control" placeholder="Nhập tiêu đề" value="{{$thongtin->tieude}}">
				</div>
			    <div class="form-group">
			    	<textarea id="noidung" name="noidung">{{$thongtin->noidung}}</textarea>
			    </div>
			    <div class="form-row">
					<div class="col-md-2 col-6">
						<button type="submit" class="btn btn-success" style="width: 100%">Thêm</button>
					</div>
					<div class="col-md-2 col-6">
						<a href="{{route('thongtin')}}"><button type="button" class="btn btn-danger" style="width: 100%">Hủy</button></a>
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
	.menu.active{
		width: 208px;
	}
</style>
@endsection

@section('script')
<script type="text/javascript" src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script>    CKEDITOR.replace( 'noidung' );</script>
@endsection
