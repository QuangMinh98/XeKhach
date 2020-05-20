@extends('admin1.master.header')

@section('noidung')

        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->

          <!-- DataTales Example -->
          <div class="card shadow md-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Chi tiết xe</h6>
            </div>
            <div class="data-form">
              <div class="panel">
                <p class="text-center text-uppercase text-primary">Thông tin tài khoản</p>
                <div class="index">
                  @if(session('thongbao'))
                  <div class="alert alert-success">
                    <strong>Success!</strong> {{session('thongbao')}}
                  </div>
                  @endif
                  @if(session('status'))
                  <div class="alert alert-danger">
                    <strong>Danger!</strong> {{session('status')}}
                  </div>
                  @endif  
                  @if(count($errors)>0)
                  <div class="alert alert-danger">
                    <strong>Danger!</strong>
                    @foreach($errors->all() as $err)
                  {{$err}}</br>
                  @endforeach
                  </div>
                  @endif
                <form action="{{route('changePasswordAdmin')}}" method="post">
                  @csrf
                  <div class="form-group">
                    <label for="id">Id:</label>
                    <input type="text" value="{{Auth::user()->id}}" disabled="true" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" value="{{Auth::user()->email}}" disabled="true" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="sdt">Nhập mật khẩu cũ:</label>
                    <input type="password" name="password" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="sdt">Nhập mật khẩu mới:</label>
                    <input type="password" name="newpass" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="sdt">Nhập lại mật khẩu mới:</label>
                    <input type="password" name="newpass2" class="form-control">
                  </div>
                  <div class="submit">
                    <button type="submit" class="btn btn-primary" style="width: 150px;">Lưu</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          </div>

        </div>
        <!-- /.container-fluid -->

@endsection


