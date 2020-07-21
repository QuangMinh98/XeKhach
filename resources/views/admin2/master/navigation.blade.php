  <nav class="main-header navbar navbar-expand navbar-orange navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('thongke')}}" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          {{Auth::user()->name}}
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="{{route('getInfo')}}" class="dropdown-item">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Thông Tin
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{route('getChangePass')}}" class="dropdown-item">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>Đổi Mật Khẩu
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Đăng Xuất
          </a>
          <div class="dropdown-divider"></div>
        </div>
      </li>
    </ul>
  </nav>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="{{asset('admin/dist/img/AdminLTELogo.png')}}"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminSite</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">Quản Lý Xe</li>
          <!-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../index.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
          </li> -->
          <li class="nav-item">
            <a href="{{route('tuyen')}}" class="nav-link  @if(Request::is('admin/tuyenxe/*')) active @endif">
              <i class='nav-icon fas fa-exchange-alt'></i>
              <p>Tuyến Xe</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('loaixe')}}" class="nav-link  @if(Request::is('admin/loaixe/*')) active @endif">
              <i class="nav-icon fas fa-car-side"></i>
              <p>Loại Xe</p>
            </a>
          </li>
          <li class="nav-item has-treeview @if(Request::is('admin/xekhach/*')) menu-open @endif">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-car-side"></i>
              <p>
                Xe Khách
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('xe')}}" class="nav-link @if(Request::is('admin/xekhach/danhsach')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('showaddxe')}}" class="nav-link @if(Request::is('admin/xekhach/add')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{route('tinh')}}" class="nav-link  @if(Request::is('admin/tinh/*')) active @endif">
              <i class="nav-icon fas fa-globe-asia"></i>
              <p>Tỉnh thành</p>
            </a>
          </li>
          <li class="nav-item has-treeview @if(Request::is('admin/chuyenxe/*')) menu-open @endif">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shuttle-van"></i>
              <p>
                Chuyến Xe
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('chuyenxe')}}" class="nav-link @if(Request::is('admin/chuyenxe/danhsach')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('showaddchuyen')}}" class="nav-link @if(Request::is('admin/chuyenxe/add')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{route('ve')}}" class="nav-link  @if(Request::is('admin/quanlyve/*')) active @endif">
              <i class="nav-icon fas fa-ticket-alt"></i>
              <p>Quản lý vé</p>
            </a>
          </li>
          <li class="nav-header">Thông tin</li>
          <li class="nav-item has-treeview @if(Request::is('admin/tintuc/*')) menu-open @endif">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-newspaper"></i>
              <p>
                Tin tức
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('tintuc')}}" class="nav-link @if(Request::is('admin/tintuc/danhsach')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('showAddTin')}}" class="nav-link @if(Request::is('admin/tintuc/add')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview @if(Request::is('admin/thongtin/*')) menu-open @endif">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-info-circle"></i>
              <p>
                Thông tin
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('thongtin')}}" class="nav-link @if(Request::is('admin/thongtin/danhsach')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('showAddThongTin')}}" class="nav-link @if(Request::is('admin/thongtin/add')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{route('lienhe')}}" class="nav-link  @if(Request::is('admin/lienhe/*')) active @endif">
              <i class="nav-icon fas fa-id-card"></i>
              <p>Liên hệ</p>
            </a>
          </li>
          <li class="nav-header">Quản lý người dùng</li>
          <li class="nav-item has-treeview @if(Request::is('admin/users/*')) menu-open @endif">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Người dùng
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin')}}" class="nav-link @if(Request::is('admin/users/quantri')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Quản trị viên</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('users')}}" class="nav-link @if(Request::is('admin/users/khachhang')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Khách hàng</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Tables
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../tables/simple.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Simple Tables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../tables/data.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DataTables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../tables/jsgrid.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>jsGrid</p>
                </a>
              </li>
            </ul>
          </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>