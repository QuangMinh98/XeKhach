@extends('teamplate.master.header')

@section('noidung')
	<div class="data">
		<div class="data-title">
			<h4>Thêm Chuyến Xe</h4>
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
			<form action="{{route('editChuyen')}}" method="post">
				@csrf
				<input type="hidden" name="id" value="{{$chuyen->id}}">
				<div class="form-row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="idhang">Hãng Xe</label>
							<select id="hang" name="idhang" class="form-control">
								@foreach($hangxe as $hx)
								@if($hx->id == $chuyen->idHang)
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
							<select id="tuyen" name="idtuyen" class="form-control">
								@foreach($tuyen as $t)
								@if($t->id == $chuyen->idTuyen)
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
							<select id="loaixe" name="idloaixe" class="form-control">
								@foreach($loaixe as $lx)
								@if($lx->id == $chuyen->idLoaiXe)
								<option value="{{$lx->id}}" selected>{{$lx->tenloaixe}}</option>
								@else
								<option value="{{$lx->id}}">{{$lx->tenloaixe}}</option>
								@endif
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="idXe">Xe:</label>
							<select id="xe" name="idxe" class="form-control">
								@foreach($xe as $x)
								@if($x->id == $chuyen->idXe)
								<option value="{{$x->id}}" selected>{{$x->tenxe}}-{{$x->biensoxe}}</option>
								@else
								<option value="{{$x->id}}">{{$x->tenxe}}-{{$x->biensoxe}}</option>
								@endif
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="idlotrinh">Lộ Trình:</label>
							<select id="lotrinh" name="idlotrinh" class="form-control">
								@foreach($lotrinh as $lt)
								@if($lt->id == $chuyen->id)
								<option value="{{$lt->id}}" selected="">
									{{$lt->noidi}}-{{$lt->tentinhdi}} &nbsp -> &nbsp {{$lt->noiden}}-{{$lt->tentinhden}}
								</option>
								@else
								<option value="{{$lt->id}}">
									{{$lt->noidi}}-{{$lt->tentinhdi}} &nbsp -> &nbsp {{$lt->noiden}}-{{$lt->tentinhden}}
								</option>
								@endif
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="ngaydi">Ngày Đi:</label>
							<input type="datetime-local" name="ngaydi" class="form-control" value="{{date_format(date_create($chuyen->giodi),'Y-m-d\TH:i')}}">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="ngayden">Ngày Đến:</label>
							<input type="datetime-local" name="ngayden" class="form-control" value="{{date_format(date_create($chuyen->gioden),'Y-m-d\TH:i')}}">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="giave">Giá Vé(VNĐ):</label>
							<input type="number" name="giave" class="form-control" value="{{$chuyen->giave}}">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-2 col-6">
						<button type="submit" class="btn btn-success" style="width: 100%">Sửa</button>
					</div>
					<div class="col-md-2 col-6">
						<a href="{{route('chuyenxe')}}"><button type="button" class="btn btn-danger" style="width: 100%">Hủy</button></a>
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

@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		$('#hang').change(function(){
			idHang = $('#hang').val();
			idLoaiXe = $('#loaixe').val();
			idTuyen = $('#tuyen').val();
			$.ajax({
				url:'{{route('ajaxxe')}}',
				type: 'get',
				data:{idHang:idHang,idTuyen:idTuyen,idLoaiXe:idLoaiXe},
				success:function(d){
					$('#xe').html(d);
				},
				error:function(){
					alert('Không thể hoàn thành thao tác');
				}
			})
		})
		$('#tuyen').change(function(){
			idHang = $('#hang').val();
			idLoaiXe = $('#loaixe').val();
			idTuyen = $('#tuyen').val();
			$.ajax({
				url:'{{route('ajaxxe')}}',
				type: 'get',
				data:{idHang:idHang,idTuyen:idTuyen,idLoaiXe:idLoaiXe},
				success:function(d){
					$('#xe').html(d);
				},
				error:function(){
					alert('Không thể hoàn thành thao tác');
				}
			})
		})
		$('#loaixe').change(function(){
			idHang = $('#hang').val();
			idLoaiXe = $('#loaixe').val();
			idTuyen = $('#tuyen').val();
			$.ajax({
				url:'{{route('ajaxxe')}}',
				type: 'get',
				data:{idHang:idHang,idTuyen:idTuyen,idLoaiXe:idLoaiXe},
				success:function(d){
					$('#xe').html(d);
				},
				error:function(){
					alert('Không thể hoàn thành thao tác');
				}
			})
		})
		$('#xe').click(function(){
			idXe = $('#xe').val();
			$.ajax({
				url:'{{route('ajaxlotrinh')}}',
				type: 'get',
				data:{idXe:idXe},
				success:function(d){
					$('#lotrinh').html(d);	
				},
				error:function(){
					alert('Không thể hoàn thành thao tác');
				}
			})
		})
		$('#xe').change(function(){
			idXe = $('#xe').val();
			$.ajax({
				url:'{{route('ajaxlotrinh')}}',
				type: 'get',
				data:{idXe:idXe},
				success:function(d){
					$('#lotrinh').html(d);	
				},
				error:function(){
					alert('Không thể hoàn thành thao tác');
				}
			})
		})
	})
</script>
@endsection