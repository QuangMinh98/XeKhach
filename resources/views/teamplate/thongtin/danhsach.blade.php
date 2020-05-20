@extends('teamplate.master.header')

@section('noidung')
	<div class="data">
		<div class="data-title">
			<div class="row">
				<div class="col-md-3">
					<form action="{{route('thongtin')}}" method="GET">
						<div class="form-group">
							<label for="search">Search:</label>
							<input type="search" name="search" id="search" class="form-control">
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
						<th>Tiêu Đề</th>
						<th>Giới Thiệu</th>
						<th>Thao Tác</th>
					</tr>
				</thead>
				<tbody>
					@foreach($thongtin as $ds)
					<tr>
						<td>{{$ds->id}}</td>
						<td>{{$ds->tieude}}</td>
						<td>
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" data-id="{{$ds->id}}" id="{{$ds->id}}" name="{{$ds->id}}" @if($ds->gioithieu == 1) checked @endif>
								<label class="custom-control-label" for="{{$ds->id}}"></label>
							</div>
						</td>
						<td>
							<a href="{{route('showEditThongTin',['id'=>$ds->id])}}">
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
				$.post('{{route('delThongTin')}}',{id:id,_token:"{{csrf_token()}}"}).done(function(){
					location.reload();
				}).fail(function(){
					alert('Không thể hoàn thành thao tác này');
				})
			}
		})
		$('.custom-control-input').click(function(){
			var id = $(this).data('id');
			var gioithieu ="0";
			if($(this).prop('checked')){
				gioithieu = "1";
			}
			else{
				gioithieu = "0";
			}
			$.ajax({
			    url: '{{route('changeGioiThieu')}}',
			    type: 'POST',
			    data:{id:id,gioithieu:gioithieu,_token:"{{csrf_token()}}"},
			    error:function(){
			    	alert('không thể hoàn thành thao tác')
			    }
			})
		})
	})
</script>
@endsection





