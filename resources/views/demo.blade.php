<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/demo.css')}}">
</head>
<body>
	<div id="mySidenav" class="sidebar">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<a class="active" href="#home">Home</a>
		<div id="drop">
			<a class="nav-link dropdown-toggle" href="#">News</a>
		</div>
		<div class="dropdown-container">
			<a href="#">Link 1</a>
			<a href="#">Link 2</a>
			<a href="#">Link 3</a>
		</div>
		<a href="#contact">Contact</a>
		<a href="#about">About</a>
	</div>
	<div class="content">
		<header>
			<span id="openNav" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
		</header>
		<section>
			<div class="breadcrumbs">
				<div class="page-header">
					<h1>Tuyến Xe</h1>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<strong>Data Table</strong>
				</div>
			</div>
			<div class="data">
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>id</th>
							<th>Tiêu Đề</th>
							<th>Tên Không Dấu</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>id</td>
							<td>Tiêu Đề</td>
							<td>Tên không dấu</td>
						</tr>
					</tbody>
				</table>
			</div>
		</section>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
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
		})
	</script>
</body>
</html>