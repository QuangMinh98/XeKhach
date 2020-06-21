  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <img src="{{asset('img/logo_transparent1.png')}}" style="width: 80px;">
        </div>
        <div class="sidebar-brand-text mx-3">Quang Minh</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Thống Kê</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Quản Lý Người Dùng
      </div>

      <!-- Nav Item - Pages Collapse Menu -->

      <li class="nav-item @if(Request::is('admin/users/*')) active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-user"></i>
          <span>Người Dùng</span>
        </a>
        <div id="collapseUser" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('admin')}}">Quản trị viên</a>
            <a class="collapse-item" href="{{route('users')}}">Khách hàng</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Quản Lý Xe
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item @if(Request::is('admin/xekhach/*')) active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-car-side"></i>
          <span>Xe Khách</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('xe')}}">Danh Sách</a>
            <a class="collapse-item" href="{{route('showaddxe')}}">Thêm Xe</a>
          </div>
        </div>
      </li>

      <li class="nav-item @if(Request::is('admin/chuyenxe/*')) active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseChuyen" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-shuttle-van"></i>
          <span>Chuyến Xe</span>
        </a>
        <div id="collapseChuyen" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('chuyenxe')}}">Danh Sách</a>
            <a class="collapse-item" href="{{route('showaddchuyen')}}">Thêm Chuyến Xe</a>
          </div>
        </div>
      </li>

      <li class="nav-item @if(Request::is('admin/tinh/*')) active @endif">
        <a class="nav-link" href="{{route('tinh')}}">
          <i class="fas fa-globe-asia"></i>
          <span>Tỉnh Thành</span></a>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item @if(Request::is('admin/loaixe/*')) active @endif">
        <a class="nav-link" href="{{route('loaixe')}}">
          <i class="fas fa-car-side"></i>
          <span>Loại Xe</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item @if(Request::is('admin/tuyenxe/*')) active @endif">
        <a class="nav-link" href="{{route('tuyen')}}">
          <i class='fas fa-exchange-alt'></i>
          <span>Tuyến Xe</span></a>
      </li>

      <li class="nav-item @if(Request::is('admin/quanlyve/*')) active @endif">
        <a class="nav-link" href="{{route('ve')}}">
          <i class="fas fa-ticket-alt"></i>
          <span>Quản Lý Vé</span></a>
      </li>

      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Thông Tin
      </div>

      <li class="nav-item @if(Request::is('admin/tintuc/*')) active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNews" aria-expanded="true" aria-controls="collapsePages">
          <i class="far fa-newspaper"></i>
          <span>Tin Tức</span>
        </a>
        <div id="collapseNews" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('tintuc')}}">Danh Sách</a>
            <a class="collapse-item" href="{{route('showAddTin')}}">Thêm Tin Tức</a>
          </div>
        </div>
      </li>

      <li class="nav-item @if(Request::is('admin/thongtin/*')) active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInfo" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-info-circle"></i>
          <span>Thông Tin</span>
        </a>
        <div id="collapseInfo" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('thongtin')}}">Danh Sách</a>
            <a class="collapse-item" href="{{route('showAddThongTin')}}">Thêm Thông Tin</a>
          </div>
        </div>
      </li>

      <li class="nav-item @if(Request::is('admin/lienhe/*')) active @endif">
        <a class="nav-link" href="{{route('lienhe')}}">
          <i class="fas fa-id-card"></i>
          <span>Liên Hệ</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>