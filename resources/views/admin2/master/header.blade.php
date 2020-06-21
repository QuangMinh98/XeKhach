<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | DataTables</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('admin/plugins/toastr/toastr.min.css')}}">
  <!-- daterange picker -->
  <!-- Google Font: Source Sans Pro -->
  @yield('style')
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
</head>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		@include('admin2.master.navigation')
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>@yield('content-title')</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								@yield('breadcrumb')
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- Main content -->
			@yield('noidung')
			<!-- /.content -->
		</div>
		<footer class="main-footer">
			<div class="float-right d-none d-sm-block">
				<b>Version</b> 3.0.6-pre
			</div>
			<strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
			reserved.
		</footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">Bạn có chắc chắn muốn đăng xuất ?</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
						<a class="btn btn-primary" href="{{route('logOutAdmin')}}">Đăng Xuất</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	@yield('script')
</body>
</html>