@extends('admin.master.master')

@section('noidung')
<section>
	<div class="breadcrumbs">
		<div class="page-header">
			<h1>Danh sách tỉnh thành</h1>
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			<strong>Data Table</strong>
		</div>
	</div>
	<div class="data">
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
		<div class="row form">
			<div class="col-md-3">
				<div class="search">
					<form action="{{route('tinh')}}" method="GET">
						<div class="form-group">
							<label for="search">Search:</label>
							<input type="search" name="search" id="search" class="form-control">
						</div>
					</form>
				</div>	
			</div>
			<div class="col-md-3">
				<form action="{{route('tinh')}}" method="GET">
					<div class="form-group">
						<label for="sort">Status:</label>
						<select onchange="this.form.submit()" name="sort" class="form-control">
							<option value="1" @if(isset($sort) and $sort==1)selected @endif>Đã Đặt</option>
							<option value="2" @if(isset($sort) and $sort==2)selected @endif>Đã Tiếp Nhận</option>
							<option value="3" @if(isset($sort) and $sort==3)selected @endif>Đã Hoàn Thành</option>
							<option value="4" @if(isset($sort) and $sort==4)selected @endif>Đã Hủy</option>
						</select>
					</div>
				</form>
			</div>
		</div>
		<div style="overflow: auto;">
			<table class="table table-bordered table-striped table-hover">
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
						@if($ds->thanhtoan == 0)
						<td>
							<span id="{{$ds->id}}" class="badge badge-warning">Chưa thanh toán</span>
							<input data-id="{{$ds->id}}" class="check" type="checkbox" name="" value="0">
						</td>
						@else
						<td>
							<span id="{{$ds->id}}" class="badge badge-primary">Đã thanh toán</span>
							<input data-id="{{$ds->id}}" class="check" type="checkbox" name="" value="1" checked>
						</td>
						@endif
						<td>{{$ds->created_at}}</td>
						<td><a href="{{route('chitietve',['id'=>$ds->id])}}" class="badge badge-info">Chi Tiết</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</section>
@endsection

@section('script')
<script type="text/javascript">
	$('.check').click(function(){
		var id = $(this).data('id');
		var thanhtoan =0;
		if($(this).prop('checked')){
			thanhtoan = 1;
			$('#'+id).html('Đã thanh toán').removeClass('badge-warning').addClass('badge-primary');
		}
		else{
			thanhtoan = 0;
			$('#'+id).html('Chưa thanh toán').removeClass('badge-primary').addClass('badge-warning');
		}
		$.ajax({
		    url: '{{route('thanhtoan')}}',
		    type: 'POST',
		    data:{id:id,thanhtoan:thanhtoan,_token:"{{csrf_token()}}"},
		    error:function(){
		    	alert('không thể hoàn thành thao tác')
		    }
		})
	})
	$('.receive').click(function(){
		var status = 1;
		var id = $(this).data('id');
		$(this).removeClass('receive').addClass('received').html('Đã Tiếp Nhận');
		$.ajax({
			url: '{{route('tiepnhan')}}',
			type: 'post',
			data:{id:id,status:status,_token:"{{csrf_token()}}"},
			success:function(d){

			},
			error:function(){
				alert('Không thể hoàn thành thao tác')
			}
		})
	})
	$('.received').click(function(){
		var status = 0;
		var id = $(this).data('id');
		$(this).html('Đã Đặt').removeClass('received').addClass('receive');
		$.ajax({
			url: '{{route('tiepnhan')}}',
			type: 'post',
			data:{id:id,status:status,_token:"{{csrf_token()}}"},
			success:function(d){
				
			},
			error:function(){
				alert('Không thể hoàn thành thao tác')
			}
		})
	})
</script>
@endsection