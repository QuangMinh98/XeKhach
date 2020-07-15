@extends('admin2.master.header')

@section('content-title')
	Danh sách các tỉnh thành
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="#">Home</a></li>
	<li class="breadcrumb-item active">Tỉnh thành</li>
@endsection

@section('noidung')
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header" style="padding: 0.25rem 0.5rem;">
						<!-- <h3 class="card-title">DataTable with default features</h3> -->
						<button class="btn btn-default" style="width: 200px;" data-toggle="modal" data-target="#myModal">Thêm dữ liệu</button>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>id</th>
									<th>Tên Tỉnh Thành</th>
									<th>Thao Tác</th>
								</tr>
							</thead>
							<tbody>
								@foreach($tinh as $list)
								<tr>
									<td>{{$list->id}}</td>
									<td>{{$list->tentinh}}</td>
									<td>
										<a href="#" class="btn btn-info btn-circle edit" data-toggle="modal" data-target="#editModal" data-id = "{{$list->id}}" data-name="{{$list->tentinh}}">
											<i class="fas fa-info-circle"></i>
										</a>
										<a href="#" class="btn btn-danger btn-circle delete" data-id = "{{$list->id}}">
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
	<div class="modal fade" id="myModal">
		<div class="modal-dialog  modal-dialog-centered">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Thêm Tỉnh Thành</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<form action="{{route('addtinh')}}" method="POST">
						@csrf
						<div class="form-group">
							<label for="name">Tên Tỉnh Thành</label>
							<input type="text" name="name" class="form-control">
						</div>
						<button type="submit" class="btn btn-success" style="width: 120px;">Thêm</button>
					</form>
				</div>

				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>

			</div>
		</div>
	</div>
	<div class="modal fade" id="editModal">
		<div class="modal-dialog  modal-dialog-centered">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Chỉnh Sửa Tỉnh Thành</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<form action="{{route('editTinh')}}" method="POST">
						@csrf
						<input type="hidden" name="id" id="edit-id">
						<div class="form-group">
							<label for="name">Tên Tỉnh Thành</label>
							<input type="text" name="name" class="form-control" id="edit-name">
						</div>
						<button type="submit" class="btn btn-success" style="width: 120px;">Sửa</button>
					</form>
				</div>

				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>

			</div>
		</div>
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
  $(".edit").click(function(){
      id = $(this).data('id');
      name = $(this).data('name');
      $('#edit-id').val(id);
      $('#edit-name').val(name);
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
	})
    </script>
    @endforeach
@endif 
@endsection