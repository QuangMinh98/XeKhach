@extends('teamplate.master.header')

@section('noidung')
	<div class="data">
		<div class="data-title">
			<div class="row">
				<div class="col-md-3">
					<form action="{{route('lienhe')}}" method="GET">
						<div class="form-group">
							<label for="search">Search:</label>
							<input type="search" name="search" id="search" class="form-control">
						</div>
					</form>	
				</div>
				<div class="col-md-3 add">
					<button class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus-circle"></i> Thêm Liên Hệ</button>
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
						<th>Loại Liên Hệ</th>
						<th>Thông Tin</th>
						<th>Thao Tác</th>
					</tr>
				</thead>
				<tbody>
					@foreach($lienhe as $list)
					<tr>
						<td>{{$list->lienhe}}</td>
						<td>{{$list->thongtin}}</td>
						<td><span class="edit" data-toggle="modal" data-target="#editModal" data-id = "{{$list->id}}" data-lienhe="{{$list->lienhe}}" data-thongtin='{{$list->thongtin}}'><i class="fas fa-pencil-alt"></i></span><span class="delete" data-id = "{{$list->id}}"><i class="fas fa-trash"></i></span></td>
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
						<h4 class="modal-title">Thêm Thông Tin Liên Hệ</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">
						<form action="{{route('addLienHe')}}" method="POST">
							@csrf
							<div class="form-group">
								<label for="lienhe">Loại Liên Hệ</label>
								<input type="text" name="lienhe" class="form-control">
							</div>
							<div class="form-group">
								<label for="thongtin">Thông Tin</label>
								<input type="text" name="thongtin" class="form-control">
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
						<h4 class="modal-title">Chỉnh Sửa Thông Tin Liên Hệ</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">
						<form action="{{route('editLienHe')}}" method="POST">
							@csrf
							<input type="hidden" name="id" id="edit-id">
							<div class="form-group">
								<label for="lienhe">Loại Liên Hệ</label>
								<input type="text" name="lienhe" class="form-control" id="edit-lienhe">
							</div>
							<div class="form-group">
								<label for="thongtin">Thông Tin</label>
								<input type="text" name="thongtin" class="form-control" id="edit-thongtin">
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
			lienhe = $(this).data('lienhe');
			thongtin = $(this).data('thongtin');
			$('#edit-id').val(id);
			$('#edit-lienhe').val(lienhe);
			$('#edit-thongtin').val(thongtin);
		})
	})
	$(".delete").click(function(){
		id = $(this).data('id');
		if (confirm("Dữ liệu xoá sẽ không khôi phục được. Bạn có thật sự muốn xoá?")) {
			$.post('{{route('delLienHe')}}',{id:id,_token:"{{csrf_token()}}"}).done(function(){
				location.reload();
			}).fail(function(){
				alert('Không thể hoàn thành thao tác này');
			})
		}
	})
</script>
@endsection

