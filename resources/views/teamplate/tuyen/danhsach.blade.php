@extends('teamplate.master.header')

@section('noidung')
	<div class="data">
		<div class="data-title">
			<div class="row">
				<div class="col-md-3">
					<form action="{{route('tuyen')}}" method="GET">
						<div class="form-group">
							<label for="search">Search:</label>
							<input type="search" name="search" id="search" class="form-control">
						</div>
					</form>	
				</div>
				<div class="col-md-3 add">
					<button class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus-circle"></i> Thêm tuyến xe</button>
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
						<th>Tên Tuyến</th>
						<th>Hoạt Động</th>
						<th>Thao Tác</th>
					</tr>
				</thead>
				<tbody>
					@foreach($tuyen as $list)
					<tr>
						<td>{{$list->id}}</td>
						<td>{{$list->tentuyen}}</td>
						<td>
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" data-id="{{$list->id}}" id="{{$list->id}}" name="{{$list->id}}" @if($list->tinhtrang == 'Hoạt Động') checked @endif>
								<label class="custom-control-label" for="{{$list->id}}"></label>
							</div>
						</td>
						<td><span class="edit" data-toggle="modal" data-target="#editModal" data-id = "{{$list->id}}" data-name="{{$list->tentuyen}}"><i class="fas fa-pencil-alt"></i></span><span class="delete" data-id = "{{$list->id}}"><i class="fas fa-trash"></i></span></td>
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
						<h4 class="modal-title">Thêm Tuyến Xe</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">
						<form action="{{route('addtuyen')}}" method="POST">
							@csrf
							<div class="form-group">
								<label for="name">Tên Tuyến</label>
								<input type="text" name="name" class="form-control">
							</div>
							<div class="form-group">
								<label for="name">Tình Trạng</label>
								<select name="status" class="form-control">
									<option value="Hoạt Động">Hoạt Động</option>
									<option value="Không Hoạt Động">Không Hoạt Động</option>
								</select>
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
						<h4 class="modal-title">Chỉnh Sửa Tuyến Xe</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">
						<form action="{{route('edittuyen')}}" method="POST">
							@csrf
							<input type="hidden" name="id" id="edit-id">
							<div class="form-group">
								<label for="name">Tên Tuyến</label>
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
			status = $(this).data('status');
			$('#edit-id').val(id);
			$('#edit-name').val(name);
		})
	})
	$(".delete").click(function(){
		id = $(this).data('id');
		if (confirm("Dữ liệu xoá sẽ không khôi phục được. Bạn có thật sự muốn xoá?")) {
			$.post('{{route('deletetuyen')}}',{id:id,_token:"{{csrf_token()}}"}).done(function(){
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
		    url: '{{route('statusTuyen')}}',
		    type: 'POST',
		    data:{id:id,status:status,_token:"{{csrf_token()}}"},
		    error:function(){
		    	alert('không thể hoàn thành thao tác')
		    }
		})
	})
</script>
@endsection

