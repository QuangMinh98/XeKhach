<nav class="navbar navbar-expand-sm navbar-dark" style="background: #ef5222;">
  <!-- Brand -->
  <a class="navbar-brand" href="#"><img class="logo" src="https://futabus.vn/Content/img/logo-futa-edit.png"></a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{route('home')}}"><i class="fas fa-home"></i><hr class="hov"></a>
      </li>
      @if(isset($gioithieu))
      <li class="nav-item">
        <a class="nav-link" href="{{route('viewThongTin',['tieude'=>$gioithieu->tenkhongdau.'-'.$gioithieu->id])}}">Giới Thiệu <hr class="hov"></a>
      </li>
      @else
      <li class="nav-item">
        <a class="nav-link" href="#">Giới Thiệu <hr class="hov"></a>
      </li>
      @endif
      <li class="nav-item">
        <a class="nav-link" href="{{route('huongdan')}}">Hướng Dẫn <hr class="hov"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('tintuc1')}}">Tin Tức <hr class="hov"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Liên Hệ <hr class="hov"></a>
      </li>
      @if(!Auth::check())
      <li class="nav-item">
        <a class="nav-link" href="{{route('viewLogin')}}">Đăng Nhập <hr class="hov"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('viewRegister')}}">Đăng Ký <hr class="hov"></a>
      </li>
      @else
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
          {{Auth::user()->name}}
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="{{route('viewInfo')}}"><i class="fas fa-info-circle"></i>&nbsp Thông Tin</a>
          <a class="dropdown-item" href="{{route('ticket')}}"><i class="fas fa-ticket-alt"></i>&nbsp Vé Của Tôi</a>
          <a class="dropdown-item" href="{{route('viewChangePassword')}}"><i class="fas fa-lock"></i>&nbsp Đổi Mật Khẩu</a>
          <a class="dropdown-item" href="{{route('logOut')}}"><i class="fas fa-sign-out-alt"></i>&nbsp Đăng Xuất</a>
        </div>
      </li>
      @endif
    </ul>
  </div>
</nav>