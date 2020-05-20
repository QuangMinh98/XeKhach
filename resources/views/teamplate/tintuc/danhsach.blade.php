@extends('teamplate.master.header')

@section('noidung')
	<div class="data">
		<div class="data-title">
			<div class="row">
				<div class="col-md-3">
					<form action="{{route('tintuc')}}" method="GET">
						<div class="form-group">
							<label for="search">Search:</label>
							<input type="search" name="search" id="search" class="form-control">
						</div>
					</form>		
				</div>
				<div class="col-md-3">
					<form action="{{route('tintuc')}}" method="GET">
						<div class="form-group">
							<label for="sort">Sort:</label>
							<select onchange="this.form.submit()" name="sort" class="form-control">
								<option value="0" @if(isset($sort) and $sort==0)selected @endif>A->Z</option>
								<option value="1" @if(isset($sort) and $sort==1)selected @endif>Z->A</option>
							</select>
						</div>
					</form>
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
						<th>Ảnh</th>
						<th>Tiêu Đề</th>
						<th>Thao Tác</th>
					</tr>
				</thead>
				<tbody>
					@foreach($tintuc as $ds)
					<tr>
						<td>{{$ds->id}}</td>
						<td><img src="{{asset($ds->img)}}" style="width: 120px; height: 50px;"></td>
						<td>{{$ds->tieude}}</td>
						<td>
							<a href="{{route('showEditTin',['id'=>$ds->id])}}">
								<span class="edit"><i class="fas fa-pencil-alt"></i></span>
							</a>
							<span class="delete" data-id = "{{$ds->id}}"><i class="fas fa-trash"></i></span>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		$(".delete").click(function(){
			id = $(this).data('id');
			if (confirm("Dữ liệu xoá sẽ không khôi phục được. Bạn có thật sự muốn xoá?")) {
				$.post('{{route('delTin')}}',{id:id,_token:"{{csrf_token()}}"}).done(function(){
					location.reload();
				}).fail(function(){
					alert('Không thể hoàn thành thao tác này');
				})
			}
		})
	})
</script>
@endsection





