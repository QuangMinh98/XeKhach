@extends('admin2.master.header')

@section('content-title')
	Chi tiết xe
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="#">Home</a></li>
	<li class="breadcrumb-item">Chuyến Xe</li>
	<li class="breadcrumb-item active">Chi tiết</li>
@endsection

@section('noidung')
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-5">
				<div class="card card-orange">
					<div class="card-header">
						<h3 class="card-title">Thông tin chuyến xe</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<input type="hidden" name="id" id="id" value="{{$chuyen->id}}">
						<strong><i class="fas fa-book mr-1"></i>Tên Xe:</strong>

						<p class="text-muted">
							{{$xe->tenxe}}
						</p>

						<hr>

						<strong><i class="fas fa-map-marker-alt mr-1"></i>Biển Số:</strong>

						<p class="text-muted">{{$xe->biensoxe}}</p>

						<hr>

						<strong><i class="fas fa-pencil-alt mr-1"></i>Tuyến Xe:</strong>

						<p class="text-muted">
							{{$chuyen->tentuyen}}
						</p>

						<hr>

						<strong><i class="far fa-file-alt mr-1"></i>Thời Gian:</strong>

						<p class="text-muted">{{$chuyen->giodi}}  <i style="padding: 0px 20px;" class="fas fa-arrow-right"></i>  {{$chuyen->gioden}}</p>

						<hr>

						<strong><i class="far fa-file-alt mr-1"></i>Số Ghế Trống:</strong>

						<p class="text-muted">{{$xe->soghe - $sove}}</p>

						<hr>
						
						<strong><i class="far fa-file-alt mr-1"></i>Tình Trạng:</strong>

						<select id="status" class="form-control form-control-sm" @if($chuyen->tinhtrang == 2) disabled @endif>
							<option value="0" @if($chuyen->tinhtrang == 0) selected  @endif>Sẵn Sàng</option>
							<option value="1" @if($chuyen->tinhtrang == 1) selected  @endif>Đang di chuyển</option>
							<option value="2" @if($chuyen->tinhtrang == 2) selected  @endif>Đã hoàn thành</option>
						</select>
						<hr>

						<strong><i class="far fa-file-alt mr-1"></i>Lộ Trình:</strong>

						<p class="text-muted">
							{{$chuyen->noidi}}--{{$chuyen->tentinhdi}}  <i style="padding: 0px 20px;" class="fas fa-arrow-right"></i>  {{$chuyen->noiden}}--{{$chuyen->tentinhden}}
						</p>
					</div>
					<!-- /.card-body -->
				</div>
			</div>
			<div class="col-md-7">
				<div class="card card-orange">
					<div class="card-header">
						<h3 class="card-title">Ghế ngồi</h3>
					</div>
					<div class="card-body">
						<input type="hidden" name="id" id="id" value="{{$xe->id}}">
						<div class="row">
							@for($i=1 ; $i<=$xe->sotang ; $i++)
							<div class="col-md-6">
								<dt style="text-align: center;">Tầng {{$i}}</dt>
								<div class="row" style="margin: 0;">
									@foreach($ghe as $seat)
									@if($seat->sotang == $i)
									<div class="col-md-3 col-3">
										@if(in_array($seat->soghe,$ve))
										<span class="seat">{{$seat->soghe}}</span>
										@else
										<span id="seat" class="seat non-choose" href="">{{$seat->soghe}}</span>
										@endif
									</div>
									@endif
									@endforeach
								</div>
							</div>
							@endfor
						</div>
					</div>
				</div>
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
</section>
@endsection

@section('style')
<link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
<style type="text/css">
	.toast{
		width: 350px !important;
	}
	.seat{
    height: 28px;
    width: 35px;
    color: #999;
    cursor: pointer;
    border: 1px solid #424242;
    border-radius: 3px;
    padding: 5px 10px;
    background: #2b2b2b;
    margin: 2px 4px 2px 2px;
    display: inline-block;
    font-weight: 700;
    font-size: 11px;
    text-align: center;
  }

  .non-choose{
    background: orange;
    color: #fff;
  }
</style>
@endsection

@section('script')
@include('admin2.master.datascript')

<script type="text/javascript">
  $(document).ready(function(){
    $('#status').change(function(){
      id = $('#id').val();
      status = $('#status').val();
      if(status == 2){
      	$('#status').attr('disabled','true');
      }
      $.ajax({
        url: '{{route('changeStatus')}}',
        type: 'get',
        data: {id:id,status:status},
        error:function(){
          alert('Không thể hoàn thành thao tác');
        }
      })
    })
  })
</script> 
@endsection