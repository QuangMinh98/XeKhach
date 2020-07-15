@extends('admin2.master.header')

@section('content-title')
	Chỉnh sửa thông tin chuyến xe
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="#">Home</a></li>
	<li class="breadcrumb-item">Xe</li>
	<li class="breadcrumb-item active">Chỉnh sửa</li>
@endsection

@section('noidung')
<section class="content">
	<div class="container-fluid">
		<!-- SELECT2 EXAMPLE -->
		<div class="card card-secondary">
			<div class="card-header">
				@if($chuyen->tinhtrang != 0)
				<h3 class="card-title">Không thể thay đổi thông tin chuyến xe này</h3>
				@else
				<h3 class="card-title">Nhập thông tin chuyến xe</h3>
				@endif
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<form action="{{route('editChuyen')}}" method="post" @if($chuyen->tinhtrang != 0) onsubmit="return false" @endif>
					@csrf
					<input type="hidden" name="id" value="{{$chuyen->id}}">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="idtuyen">Tuyến Xe Chạy:</label>
								<select id="tuyen" name="idtuyen" class="form-control select2">
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
						<div class="col-md-6">
							<div class="form-group">
								<label for="idloaixe">Loại Xe:</label>
								<select id="loaixe" name="idloaixe" class="form-control select2">
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
						<div class="col-md-4">
							<div class="form-group">
								<label for="idXe">Xe:</label>
								<select id="xe" name="idxe" class="form-control select2">
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
									@if($lt->id == $chuyen->idLoTrinh)
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
						<div class="col-md-4">
							
						</div>
						<div class="col-md-2 col-6">
							<button type="submit" class="btn btn-success" style="width: 100%">Chỉnh Sửa</button>
						</div>
						<div class="col-md-2 col-6">
							<a href="{{route('chuyenxe')}}"><button type="button" class="btn btn-danger" style="width: 100%">Hủy</button></a>
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
<script type="text/javascript">
  $(document).ready(function(){
    $('#tuyen').change(function(){
      idLoaiXe = $('#loaixe').val();
      idTuyen = $('#tuyen').val();
      $.ajax({
        url:'{{route('ajaxxe')}}',
        type: 'get',
        data:{idTuyen:idTuyen,idLoaiXe:idLoaiXe},
        success:function(d){
          $('#xe').html(d);
        },
        error:function(){
          alert('Không thể hoàn thành thao tác');
        }
      })
    })
    $('#loaixe').change(function(){
      idLoaiXe = $('#loaixe').val();
      idTuyen = $('#tuyen').val();
      $.ajax({
        url:'{{route('ajaxxe')}}',
        type: 'get',
        data:{idTuyen:idTuyen,idLoaiXe:idLoaiXe},
        success:function(d){
          $('#xe').html(d);
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