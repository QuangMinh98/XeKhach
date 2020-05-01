@extends('teamplate.master.header')

@section('noidung')
	<div class="data">
		<div class="data-title">
			<div class="row">
				<div class="col-md-3">
					<form action="{{route('ve')}}" method="GET">
						<div class="form-group">
							<label for="search">Search:</label>
							<input type="search" name="search" id="search" class="form-control">
						</div>
					</form>		
				</div>
				<div class="col-md-3">
					<form action="{{route('ve')}}" method="GET">
						<div class="form-group">
							<label for="sort">Status:</label>
							<select onchange="this.form.submit()" name="sort" class="form-control">
								<option value="0" @if(isset($sort) and $sort==0)selected @endif>Đã Đặt</option>
								<option value="1" @if(isset($sort) and $sort==1)selected @endif>Đã Tiếp Nhận</option>
								<option value="2" @if(isset($sort) and $sort==2)selected @endif>Đã Hoàn Thành</option>
								<option value="3" @if(isset($sort) and $sort==3)selected @endif>Đã Hủy</option>
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
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" data-id="{{$ds->id}}" id="customCheck" name="example1" @if($ds->thanhtoan == 1) checked @endif>
								<label class="custom-control-label" for="customCheck"></label>
							</div>
						</td>
						<td>{{$ds->created_at}}</td>
						<td><a href="{{route('chitietve',['id'=>$ds->id])}}" class="badge badge-info">Chi Tiết</a></td>
					</tr>
					@endforeach
				</tbody>
				</tbody>
			</table>
		</div>
	</div>
@endsection

@section('script')
<script type="text/javascript">
	$('.custom-control-input').click(function(){
		var id = $(this).data('id');
		var thanhtoan =0;
		if($(this).prop('checked')){
			thanhtoan = 1;
		}
		else{
			thanhtoan = 0;		}
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
@endsection



