<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Đặt vé xe khách</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('css/user.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    @yield('style')
</head>
<body>
	<header style="background: #28a745">
		<div class="container">
			@include('user.master.navigation')
		</div>
	</header>
	@yield('noidung')
	<div class="footer">
		<div class="container" style="background: #28a745">
			<div class="row">
				<div class="col-md-6">
					<h4>Thông Tin:</h4>
					<a href="">Giới Thiệu</a><br>
					<a href="">Liên Hệ</a><br>
					<a href="">Tin Tức</a>
				</div>
				<div class="col-md-6">
					<h4>Hướng dẫn:</h4>
					<a href="">Hướng dẫn thanh toán</a><br>
					<a href="">Hướng dẫn đặt vé</a>
				</div>
				<div class="col-md-8" style="padding-top: 20px;">
					<h4>Kết nối với chúng tôi tại:</h4>
					<a href="" style="font-size: 40px;"><i class="fab fa-facebook"></i></a>&nbsp &nbsp &nbsp &nbsp<a href="" style="font-size: 40px;"><i class="fab fa-google"></i></a>
				</div>
			</div>
		</div>
		@yield('script')
	</div>
</body>
</html>