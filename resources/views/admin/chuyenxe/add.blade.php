@extends('admin.master.master')

@section('noidung')
<section>
	<div class="breadcrumbs">
		<div class="page-header">
			<h1>Thêm Chuyến Xe</h1>
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
		<form action="{{route('addchuyen')}}" method="POST" enctype="multipart/form-data" >
			@csrf
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="idhang">Hãng Xe</label>
						<select id="hang" name="idhang" class="form-control">
							@foreach($hangxe as $hx)
								<option value="{{$hx->id}}">{{$hx->tenhang}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="idtuyen">Tuyến Xe Chạy:</label>
						<select id="tuyen" name="idtuyen" class="form-control">
							@foreach($tuyen as $t)
								<option value="{{$t->id}}">{{$t->tentuyen}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="idloaixe">Loại Xe:</label>
						<select id="loaixe" name="idloaixe" class="form-control">
							@foreach($loaixe as $lx)
								<option value="{{$lx->id}}">{{$lx->tenloaixe}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<label for="idXe">Xe:</label>
					<select id="xe" name="idxe" class="form-control">
						@foreach($xe as $x)
						<option value="{{$x->id}}">{{$x->tenxe}}-{{$x->biensoxe}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-4">
					<label for="idlotrinh">Lộ Trình:</label>
						<select id="lotrinh" name="idlotrinh" class="form-control">
						</select>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="ngaydi">Ngày Đi:</label>
						<input type="datetime-local" name="ngaydi" class="form-control">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="ngayden">Ngày Đến:</label>
						<input type="datetime-local" name="ngayden" class="form-control">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="giave">Giá Vé(VNĐ):</label>
						<input type="number" name="giave" class="form-control">
					</div>
				</div>
				<div class="col-md-4">
					
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