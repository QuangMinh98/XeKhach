<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('css/user.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    @yield('style')
</head>
<body>
	<div id="preload" class="preload-container text-center">
        <span class="fas fa-spinner preload-icon rotating"></span>
      </div>
	<header style="background: #ef5222; margin-bottom: 20px;">
		<div class="container">
			@include('user.master.navigation')
		</div>
	</header>
	@yield('noidung')
  <section id="body-news" class="container">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-ms-12">
        <div class="item-block">
          <div class="items-news text-center wow fadeInUp  animated" data-wow-offset="15" data-wow-duration="1.2s" style="visibility: visible; animation-duration: 1.2s; animation-name: B;">
            <img src="{{asset('img/customer.png')}}">
            <h5>
              <a href="">Hơn 20 triệu lượt khách</a>

            </h5>
            <p>Quang Minh phục vụ hơn 20 triệu lượt khách/ bình quân 1 năm trên toàn quốc</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-ms-12">
        <div class="item-block">
          <div class="items-news text-center wow fadeInUp  animated" data-wow-offset="15" data-wow-duration="1.2s" style="visibility: visible; animation-duration: 1.2s; animation-name: B;">
            <img src="{{asset('img/home.png')}}">
            <h5>
              <a href="">Hơn 200 Phòng vé, Trạm trung chuyển</a>

            </h5>
            <p>Quang Minh có hơn 100 Phòng vé, Trạm trung chuyển, Bến xe... trên toàn hệ thống</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-ms-12">
        <div class="item-block">
          <div class="items-news text-center wow fadeInUp  animated" data-wow-offset="15" data-wow-duration="1.2s" style="visibility: visible; animation-duration: 1.2s; animation-name: B;">
            <img src="{{asset('img/tech.png')}}">
            <h5>
              <a href="">Hơn 1,000 chuyến mỗi ngày</a>

            </h5>
            <p>Quang Minh phục vụ hơn 1000 chuyến xe đường dài và liên tỉnh mỗi ngày.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
	<div class="footer">
		<div class="container" style="background: #ef5222;">
			<div class="row">
				<div class="col-md-6">
					<h4>Thông Tin:</h4>
          @if(isset($gioithieu))
					<a href="{{route('viewThongTin',['tieude'=>$gioithieu->tenkhongdau.'-'.$gioithieu->id])}}" style="color: #fff;">Giới Thiệu</a><br>
          @else
          <a href="#" style="color: #fff;">Giới Thiệu</a><br>
          @endif
					<a href="" style="color: #fff;">Liên Hệ</a><br>
					<a href="{{route('tintuc1')}}" style="color: #fff;">Tin Tức</a>
				</div>
				<div class="col-md-6">
					<h4>Hướng dẫn:</h4>
          @foreach($huongdan1 as $ds)
					<a href="{{route('viewThongTin',['tieude'=>$ds->tenkhongdau.'-'.$ds->id])}}" style="color: #fff;">{{$ds->tieude}}</a><br>
          @endforeach
				</div>
				<div class="col-md-8" style="padding-top: 20px;">
					<h4>Kết nối với chúng tôi tại: &nbsp &nbsp &nbsp &nbsp <a href="" style="font-size: 30px; color: #fff;"><i class="fab fa-facebook"></i></a>&nbsp &nbsp &nbsp &nbsp<a href="" style="font-size: 30px; color: #fff;"><i class="fab fa-google"></i></a></h4>
					
				</div>
			</div>
		</div>
		@yield('script')
		<script>
      document.addEventListener('DOMContentLoaded', function() {
                var mediaElements = document.querySelectorAll('video, audio'), total = mediaElements.length;
                for (var i = 0; i < total; i++) {
                    new MediaElementPlayer(mediaElements[i], {
                        pluginPath: 'https://cdn.jsdelivr.net/npm/mediaelement@4.2.7/build/',
                        shimScriptAccess: 'always',
                        success: function () {
                            var target = document.body.querySelectorAll('.player'), targetTotal = target.length;
                            for (var j = 0; j < targetTotal; j++) {
                                target[j].style.visibility = 'visible';
                            }
                  }
                });
                }
            });
      $(window).on("load",function(){
      	 
          $('body').removeClass('preloading');
          $('#preload').fadeOut('fast');
      });
    </script>
    <style type="text/css">
  .preloading {
    overflow: hidden;
}
.preload-container {
    width: 100%;
    height: 100%;
    background: #00b8ff;
    position: fixed;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    z-index: 99999999999;
    display: block;
    padding-right: 17px;
    overflow-x: hidden;
    overflow-y: auto;
}
.preload-icon {
    font-size: 66px;
    color: #fff;
    margin-top: 20%;
}
@-webkit-keyframes {
  from {
    -webkit-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  to {
    -webkit-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes rotating {
  from {
    -ms-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -webkit-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  to {
    -ms-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -webkit-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
.rotating {
  -webkit-animation: rotating 1.5s linear infinite;
  -moz-animation: rotating 1.5s linear infinite;
  -ms-animation: rotating 1.5s linear infinite;
  -o-animation: rotating 1.5s linear infinite;
  animation: rotating 1.5s linear infinite;
}
</style>

	</div>
</body>
</html>