<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    @yield('style')
</head>
<body>
	<div id="mySidenav" class="sidebar">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<a class="@if(Request::is('admin/tuyenxe/*')) active @endif" href="{{route('tuyen')}}"><i class='fas fa-exchange-alt'></i>&nbsp Tuyến Xe</a>
		<a class="@if(Request::is('admin/xekhach/*')) active @endif" href="{{route('xe')}}"><i class="fas fa-bus"></i>&nbsp Xe Khách</a>
		<div id="drop">
			<a class="@if(Request::is('admin/chuyenxe/*')) active @endif"><i class="fas fa-shuttle-van"></i>&nbsp Chuyến Xe</a>
		</div>
		<div class="dropdown-container">
			<a href="{{route('chuyenxe')}}">Danh Sách</a>
			<a href="{{route('showaddchuyen')}}">Thêm Chuyến Xe</a>
		</div>
		<a class="@if(Request::is('admin/tinh/*')) active @endif" href="{{route('tinh')}}"><i class="fas fa-globe-asia"></i>&nbsp Tỉnh Thành</a>
		<a class="@if(Request::is('admin/hangxe/*')) active @endif" href="{{route('hang')}}"><i class="fas fa-ad"></i>&nbsp Hãng Xe</a>
		<a class="@if(Request::is('admin/loaixe/*')) active @endif" href="{{route('loaixe')}}"><i class="fas fa-car-side"></i>&nbsp Loại Xe</a>
		<a class="@if(Request::is('admin/quanlyve/*')) active @endif" href="{{route('ve')}}"><i class="fas fa-ticket-alt"></i>&nbsp Quản Lý Vé</a>
		<div id="drop-users">
			<a class="@if(Request::is('admin/users/*')) active @endif"><i class="fas fa-user"></i>&nbsp Người Dùng</a>
		</div>
		<div class="dropdown-users">
			<a href="{{route('admin')}}">Quản Trị Viên</a>
			<a href="{{route('users')}}">Khách Hàng</a>
		</div>
	</div>
	<div class="content">
		<header>
			<span id="openNav" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
		</header>
		@yield('noidung')
	</div>
	<script>
		function openNav() {
		  document.getElementById("mySidenav").style.width = "250px";
		}

		function closeNav() {
		  document.getElementById("mySidenav").style.width = "0";
		}
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#drop').click(function(){
				$('.dropdown-container').slideToggle(500);
			})
			$('#drop-users').click(function(){
				$('.dropdown-users').slideToggle(500);
			})
		})
	</script>
	@yield('script')
</body>
</html>
</body>