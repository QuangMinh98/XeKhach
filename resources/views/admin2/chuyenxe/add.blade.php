@extends('admin2.master.header')

@section('content-title')
	Thêm chuyến xe mới
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="#">Home</a></li>
	<li class="breadcrumb-item">Chuyến Xe</li>
	<li class="breadcrumb-item active">Thêm</li>
@endsection

@section('noidung')
<section class="content">
	<div class="container-fluid">
		<!-- SELECT2 EXAMPLE -->
		<div class="card card-secondary">
			<div class="card-header">
				<h3 class="card-title">Nhập thông tin chuyến xe</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<form action="{{route('addchuyen')}}" method="post">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="idtuyen">Tuyến Xe Chạy:</label>
								<select id="tuyen" name="idtuyen" class="form-control select2" style="width: 100%;">
									@foreach($tuyen as $t)
									<option value="{{$t->id}}">{{$t->tentuyen}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="idloaixe">Loại Xe:</label>
								<select id="loaixe" name="idloaixe" class="form-control select2" style="width: 100%;">
									@foreach($loaixe as $lx)
									<option value="{{$lx->id}}">{{$lx->tenloaixe}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="idXe">Xe:</label>
								<select id="xe" name="idxe" class="form-control" style="width: 100%;">
									@foreach($xe as $x)
									<option value="{{$x->id}}">{{$x->tenxe}}-{{$x->biensoxe}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="idlotrinh">Lộ Trình:</label>
								<select id="lotrinh" name="idlotrinh" class="form-control" style="width: 100%;">
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="ngaydi">Ngày Đi:</label>
								<input type="datetime-local" name="ngaydi" class="form-control" style="width: 100%;">
								<span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                    </span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="ngayden">Ngày Đến:</label>
								<input type="datetime-local" name="ngayden" class="form-control" style="width: 100%;">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="giave">Giá Vé(VNĐ):</label>
								<input type="number" name="giave" class="form-control" style="width: 100%;">
							</div>
						</div>
						<div class="col-md-4">
							
						</div>
						<div class="col-md-2 col-6">
							<button type="submit" class="btn btn-success" style="width: 100%">Thêm</button>
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