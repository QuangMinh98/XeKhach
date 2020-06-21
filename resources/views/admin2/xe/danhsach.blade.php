@extends('admin2.master.header')

@section('content-title')
	Danh sách xe
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="#">Home</a></li>
	<li class="breadcrumb-item">Xe</li>
	<li class="breadcrumb-item active">Danh Sách</li>
@endsection

@section('noidung')
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header" style="padding: 0.25rem 0.5rem;">
						<!-- <h3 class="card-title">DataTable with default features</h3> -->
						<a href="{{route('showaddxe')}}"><button class="btn btn-default" style="width: 200px;">Thêm dữ liệu</button></a>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Tên Xe</th>
									<th>Tuyến Xe</th>
									<th>Biển Số</th>
									<th>Hoạt Động</th>
									<th>Chi Tiết</th>
									<th>Thao Tác</th>
								</tr>
							</thead>
							<tbody>
								@foreach($xe as $ds)
								<tr>
									<td>{{$ds->tenxe}}</td>
									<td>{{$ds->tentuyen}}</td>
									<td>{{$ds->biensoxe}}</td>
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" data-id="{{$ds->idXe}}" id="{{$ds->idXe}}" name="{{$ds->idXe}}" @if($ds->tinhtrang == 'Hoạt Động') checked @endif>
											<label class="custom-control-label" for="{{$ds->idXe}}"></label>
										</div>
									</td>
									<td><a href="{{route('detailxe',['id'=>$ds->idXe])}}" class="badge badge-info">Chi Tiết</a></td>
									<td>
										<a href="{{route('showeditxe',['id'=>$ds->idXe])}}" class="btn btn-info btn-circle edit">
											<i class="fas fa-info-circle"></i>
										</a>
										<a href="#" class="btn btn-danger btn-circle delete" data-id = "{{$ds->idXe}}">
											<i class="fas fa-trash"></i>
										</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
</section>
@endsection

@section('style')
@include('admin2.master.datastyle')
<style type="text/css">
	.toast{
		width: 350px !important;
	}
</style>
@endsection

@section('script')
@include('admin2.master.datascript')
<script type="text/javascript">
  $(".delete").click(function(){
      id = $(this).data('id');
      if (confirm("Dữ liệu xoá sẽ không khôi phục được. Bạn có thật sự muốn xoá?")) {
        $.post('{{route('delXe')}}',{id:id,_token:"{{csrf_token()}}"}).done(function(){
          location.reload();
        }).fail(function(){
          alert('Không thể hoàn thành thao tác này');
        })
      }
    })
    $('.custom-control-input').click(function(){
      var id = $(this).data('id');
      var status ="Hoạt Động";
      if($(this).prop('checked')){
        status = "Hoạt Động";
      }
      else{
        status = "Không Hoạt Động";
      }
      $.ajax({
          url: '{{route('statusXe')}}',
          type: 'POST',
          data:{id:id,status:status,_token:"{{csrf_token()}}"},
          error:function(){
            alert('không thể hoàn thành thao tác')
          }
      })
    })
</script>
@if(session('thongbao'))
<script type="text/javascript">
	$(document).ready(function(){
		var Toast = Swal.mixin({
	      toast: true,
	      position: 'top-end',
	      showConfirmButton: false,
	      timer: 3000
	    });
		$(document).Toasts('create', {
        class: 'bg-success',
        title: 'Success',
        subtitle: 'Subtitle',
        body: '{{session('thongbao')}}'
      })
	})
</script>
@endif

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
    </script>
    @endforeach
@endif 
@endsection