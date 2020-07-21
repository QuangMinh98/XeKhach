@extends('admin2.master.header')

@section('content-title')
	Home
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="#">Home</a></li>
@endsection

@section('noidung')
<section class="content">
	<div class="container-fluid">
		<form action="{{route('thongke')}}" method="get">
			<div class="form-group">
				<input type="date" name="date" class="form-control" onchange="this.form.submit()" value="{{$date}}">
			</div>
		</form>
		<div class="row">
			<div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$vengay}}</h3>

                <p>Vé đã đặt trong ngày</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$vethang}}</h3>

                <p>Vé đã đặt trong tháng</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$chuyenngay}}</h3>

                <p>Chuyến xe trong ngày</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$chuyenthang}}</h3>

                <p>Chuyến xe trong tháng</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
		</div>
		<div class="card bg-gradient-success">
			<div class="card-header border-0">
				<h3 class="card-title">
					<i class="far fa-calendar-alt"></i>
					Calendar
				</h3>
				<!-- tools card -->
				<div class="card-tools">
					<!-- button with a dropdown -->
					<div class="btn-group">
						<button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
							<i class="fas fa-bars"></i></button>
							<div class="dropdown-menu" role="menu">
								<a href="#" class="dropdown-item">Add new event</a>
								<a href="#" class="dropdown-item">Clear events</a>
								<div class="dropdown-divider"></div>
								<a href="#" class="dropdown-item">View calendar</a>
							</div>
						</div>
						<button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
							<i class="fas fa-minus"></i>
						</button>
						<button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
							<i class="fas fa-times"></i>
						</button>
					</div>
					<!-- /. tools -->
				</div>
				<!-- /.card-header -->
				<div class="card-body pt-0">
					<!--The calendar -->
					<div id="calendar" style="width: 100%"></div>
				</div>
				<!-- /.card-body -->
			</div>
		<div class="row">
			<section>
				
			</section>
			<section>
				
			</section>
		</div>
	</div>
</section>
@endsection

@section('style')
@include('admin2.master.dashboardstyle')
@endsection

@section('script')
@include('admin2.master.dashboardscript')
@endsection