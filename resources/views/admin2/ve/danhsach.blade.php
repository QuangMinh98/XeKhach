@extends('admin2.master.header')

@section('content-title')
	Quản lý vé
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="#">Home</a></li>
	<li class="breadcrumb-item active">Quản lý vé</li>
@endsection

@section('noidung')
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header" style="padding: 0.25rem 0.5rem;">
						<!-- <h3 class="card-title">DataTable with default features</h3> -->
						<div class="row">
							<div class="col-md-3 col-6">
								<form action="{{route('ve')}}" method="GET">
									<div class="form-group">
										<label for="sort">Tình Trạng:</label>
										<select onchange="this.form.submit()" name="sort" class="form-control">
											<option value="-1" @if(isset($sort) and $sort==0)selected @endif>Tất Cả</option>
											<option value="0" @if(isset($sort) and $sort==0)selected @endif>Đã Đặt</option>
											<option value="1" @if(isset($sort) and $sort==1)selected @endif>Đã Tiếp Nhận</option>
											<option value="2" @if(isset($sort) and $sort==2)selected @endif>Đã Hoàn Thành</option>
											<option value="3" @if(isset($sort) and $sort==3)selected @endif>Đã Hủy</option>
										</select>
									</div>
								</form>
							</div>
							<div class="col-md-3 col-6">
								<form action="{{route('ve')}}" method="GET">
									<div class="form-group">
										<label for="search">Tìm kiếm mã vé:</label>
										<input type="search" name="search" class="form-control" id="search">
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>id</th>
									<th>Tình Trạng</th>
									<th>Thanh Toán</th>
									<th>Ngày Đặt</th>
									<th>Chi Tiết</th>
								</tr>
							</thead>
							<tbody>
								@foreach($ve as $ds)
								<tr>
									<td>{{$ds->id}}</td>
									@switch($ds->tinhtrang)
									@case (0)
									<td><a href="javascript:" data-id="{{$ds->id}}" class="badge badge-primary receive" href="">Đã Đặt</a></td>
									@break
									@case (1)
									<td><a href="javascript:" data-id="{{$ds->id}}" class="badge badge-info received">Đã Tiếp Nhận</a></td>
									@break
									@case (2)
									<td><span class="badge badge-success">Đã Hoàn Thành</span></td>
									@break
									@case (3)
									<td><span class="badge badge-danger">Đã Hủy</span></td>
									@break
									@endswitch
									<td>
										@if($ds->tinhtrang == 2 || $ds->tinhtrang ==3)
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" data-id="{{$ds->id}}" id="{{$ds->id}}" name="{{$ds->id}}" @if($ds->thanhtoan == 1) checked @endif disabled>
											<label class="custom-control-label" for="{{$ds->id}}"></label>
										</div>
										@else
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" data-id="{{$ds->id}}" id="{{$ds->id}}" name="{{$ds->id}}" @if($ds->thanhtoan == 1) checked @endif>
											<label class="custom-control-label" for="{{$ds->id}}"></label>
										</div>
										@endif
									</td>
									<td> {{date('d-m-yy G:i',strtotime($ds->created_at)+7*60*60)}}</td>
									<td><a href="{{route('chitietve',['id'=>$ds->id])}}" class="badge badge-info">Chi Tiết</a></td>
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
  $('.custom-control-input').click(function(){
    var id = $(this).data('id');
    var thanhtoan =0;
    if($(this).prop('checked')){
      thanhtoan = 1;
    }
    else{
      thanhtoan = 0;    }
    $.ajax({
        url: '{{route('thanhtoan')}}',
        type: 'POST',
        data:{id:id,thanhtoan:thanhtoan,_token:"{{csrf_token()}}"},
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