@extends('teamplate.master.header')

@section('noidung')
	<div class="data">
		<div class="data-title">
			<div class="row">
				<div class="col-md-3">
					<form action="{{route('loaixe')}}" method="GET">
						<div class="form-group">
							<label for="search">Search:</label>
							<input type="search" name="search" id="search" class="form-control">
						</div>
					</form>	
				</div>
				<div class="col-md-3 add">
					<button class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus-circle"></i> Thêm Loại Xe</button>
				</div>
			</div>
		</div>
		<div class="data-table">
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
			<table class="table table-hover">
				<thead class="thead-light">
					<tr>
						<th>id</th>
						<th>Tên Tỉnh Thành</th>
						<th>Thao Tác</th>
					</tr>
				</thead>
				<tbody>
					@foreach($loaixe as $list)
					<tr>
						<td>{{$list->id}}</td>
						<td>{{$list->tenloaixe}}</td>
						<td><span class="edit" data-toggle="modal" data-target="#editModal" data-id = "{{$list->id}}" data-name="{{$list->tenloaixe}}"><i class="fas fa-pencil-alt"></i></span><span class="delete" data-id = "{{$list->id}}"><i class="fas fa-trash"></i></span></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="modal fade" id="myModal">
			<div class="modal-dialog  modal-dialog-centered">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">Thêm Loại Xe</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">
						<form action="{{route('addloaixe')}}" method="POST">
							@csrf
							<div class="form-group">
								<label for="name">Tên Loại Xe</label>
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
						<h4 class="modal-title">Chỉnh Sửa Loại Xe</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">
						<form action="{{route('editloaixe')}}" method="POST">
							@csrf
							<input type="hidden" name="id" id="edit-id">
							<div class="form-group">
								<label for="name">Tên Loại Xe</label>
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
	</div>
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		$(".edit").click(function(){
			id = $(this).data('id');
			name = $(this).data('name');
			$('#edit-id').val(id);
			$('#edit-name').val(name);
		})
	})
	$(".delete").click(function(){
		id = $(this).data('id');
		if (confirm("Dữ liệu xoá sẽ không khôi phục được. Bạn có thật sự muốn xoá?")) {
			$.post('{{route('deleteloaixe')}}',{id:id,_token:"{{csrf_token()}}"}).done(function(){
				location.reload();
			}).fail(function(){
				alert('Không thể hoàn thành thao tác này');
			})
		}
	})
</script>
@endsection

