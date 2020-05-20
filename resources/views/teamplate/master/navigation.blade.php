<div class="menu">
    <div class="heading">
      <p>Cefar</p>
      <div class="menu-icon js-toggle-menu">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div class="wrap">
      <a href="{{route('admin')}}">Quản Trị Viên</a>
      <a href="{{route('users')}}">Khách Hàng</a>

      <p class="title">Quản Lý Xe</p>

      <a href="{{route('tuyen')}}">Tuyến Xe</a>
      <a href="{{route('loaixe')}}">Loại Xe</a>

      <div class="dropdown">
        <p>Hãng Xe</p>
        <div class="links" style="height: auto;">
          <a href="{{route('hang')}}">Danh Sách</a>
          <a href="{{route('showAdd')}}">Thêm Hãng Xe</a>
        </div>
      </div>
      <div class="dropdown">
        <p>Xe</p>
        <div class="links" style="height: auto;">
          <a href="{{route('xe')}}">Danh Sách</a>
          <a href="{{route('showaddxe')}}">Thêm Xe</a>
        </div>
      </div>
      <a href="{{route('tinh')}}">Tỉnh Thành</a>
      <div class="dropdown">
        <p>Chuyến Xe</p>
        <div class="links" style="height: auto;">
          <a href="{{route('chuyenxe')}}">Danh Sách</a>
          <a href="{{route('showaddchuyen')}}">Thêm Chuyến Xe</a>
        </div>
      </div>
      <a href="{{route('ve')}}">Quản Lý Vé</a>
      <p class="title">Thông Tin</p>
      <div class="dropdown">
        <p>Tin Tức</p>
        <div class="links" style="height: auto;">
          <a href="{{route('tintuc')}}">Danh Sách Tin Tức</a>
          <a href="{{route('showAddTin')}}">Thêm Tin Tức</a>
        </div>
      </div>
      <div class="dropdown">
        <p>Hướng Dẫn &amp; Giới Thiệu</p>
        <div class="links" style="height: auto;">
          <a href="{{route('thongtin')}}">Danh Sách</a>
          <a href="{{route('showAddThongTin')}}">Thêm</a>
        </div>
      </div>
      <a href="{{route('lienhe')}}">Thông Tin Liên Hệ</a>
    </div>
  </div>