@extends('teamplate.master.header')

@section('noidung')
	<div class="data">
		<div class="data-title">
			<div class="row">
				<div class="col-md-3">
					<form action="{{route('hang')}}" method="GET">
						<div class="form-group">
							<label for="search">Search:</label>
							<input type="search" name="search" id="search" class="form-control">
						</div>
					</form>	
				</div>
				<div class="col-md-3">
					<form>
						<label for="sort">Hãng Xe:</label>
						<select name="sort" class="form-control" onchange="this.form.submit()">
							@foreach($hang as $list)
							<option value="{{$list->id}}" @if(isset($sort) and $sort==1)selected @endif>{{$list->tenhang}}</option>
							@endforeach
						</select>
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
						<th>Tên Xe</th>
						<th>Hãng Xe</th>
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
						<td>{{$ds->tenhang}}</td>
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
							<a href="{{route('showeditxe',['id'=>$ds->idXe])}}">
								<span class="edit"><i class="fas fa-pencil-alt"></i></span>
							</a>
							<span class="delete" data-id = "{{$ds->idXe}}"><i class="fas fa-trash"></i></span>
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
	})
</script>
@endsection

