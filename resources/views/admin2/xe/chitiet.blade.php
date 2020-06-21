@extends('admin2.master.header')

@section('content-title')
	Chi tiết xe
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="#">Home</a></li>
	<li class="breadcrumb-item">Xe</li>
	<li class="breadcrumb-item active">Chi tiết</li>
@endsection

@section('noidung')
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-5">
				<div class="card card-orange">
					<div class="card-header">
						<h3 class="card-title">Thông tin xe</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
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
							{{$tuyen->tentuyen}}
						</p>

						<hr>

						<strong><i class="far fa-file-alt mr-1"></i>Số Tầng:</strong>

						<p class="text-muted">{{$xe->sotang}}</p>

						<hr>

						<strong><i class="far fa-file-alt mr-1"></i>Số Ghế:</strong>

						<p class="text-muted">{{$xe->soghe}}</p>

						<hr>
						
						<strong><i class="far fa-file-alt mr-1"></i>Tình Trạng:</strong>

						<p class="text-muted">
							@if($xe->tinhtrang == 'Hoạt Động')
                              <span class="badge badge-primary">Hoạt Động</span>
                              @else
                              <span class="badge badge-danger">Không Hoạt Động</span>
                              @endif
						</p>

						<hr>

						<strong><i class="far fa-file-alt mr-1"></i>Lộ Trình:</strong>

						<p class="text-muted">
							{{$lotrinh->noidi}}--{{$lotrinh->tentinhdi}}  <i style="padding: 0px 20px;" class="fas fa-exchange-alt"></i>  {{$lotrinh->noiden}}--{{$lotrinh->tentinhden}}
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
						<div class="form-group">
							<label for="tang">Tầng:</label>
							<select id="tang" name="tang" class="form-control form-control-sm">
								@for($i = 1 ; $i<=$xe->sotang ; $i++)
								<option value="{{$i}}">Tầng {{$i}}</option>
								@endfor
							</select>
						</div>
						<div class="form-group">
							<label for="from">Số Ghế Bắt Đầu:</label>
							<select id="from" name="from" class="form-control form-control-sm">
								@foreach($ghe as $seat)
								<option value="{{$seat->soghe}}">{{$seat->soghe}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="to">Số Ghế Kết Thúc:</label>
							<select id="to" name="to" class="form-control form-control-sm">
								@foreach($ghe as $seat)
								<option value="{{$seat->soghe}}">{{$seat->soghe}}</option>
								@endforeach
							</select>
						</div>
						<button id="save" class="btn btn-primary" style="margin-bottom: 50px;">Lưu</button>
						<div class="row">
							@for($i=1 ; $i<=$xe->sotang ; $i++)
							<div class="col-md-6">
								<dt style="text-align: center;">Tầng {{$i}}</dt>
								<div class="row" style="margin: 0;">
									@foreach($ghe as $seat)
									@if($seat->sotang == $i)
									<div class="col-md-3 col-3">
										<span class="seat">{{$seat->soghe}}</span>
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
</style>
@endsection

@section('script')
@include('admin2.master.datascript')

<script type="text/javascript">
  $(document).ready(function(){
    $('#save').click(function(){
      var id = $('#id').val();
      var tang = $('#tang').val();
      var from = $('#from').val();
      var to = $('#to').val();
      $.ajax({
        url: '{{route('editSeat')}}',
        type: 'get',
        data: {id:id,tang:tang,from:from,to:to},
        success:function(d){
          alert(d);
          location.reload();
        },
        error:function(){
          alert('Không thể hoàn thành thao tác');
        }
      })
    })
  })
</script> 
@endsection