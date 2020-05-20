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
                  @if(count($errors)>0)
                  <div class="alert alert-danger">
                    <strong>Danger!</strong>
                    @foreach($errors->all() as $err)
                  {{$err}}</br>
                  @endforeach
                </div>
                @endif
                <form action="{{route('changeInfoAdmin')}}" method="post">
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
                    <label for="sdt">Tên người dùng:</label>
                    <input type="text" id="name" name="name" value="{{Auth::user()->name}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="sdt">Số điện thoại:</label>
                    <input type="text" id="sdt" name="phone" value="{{Auth::user()->phone}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="diachi">Địa chỉ:</label>
                    <input type="text" id="sdt" name="address" value="{{Auth::user()->address}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="diachi">Ngày sinh:</label>
                    <input type="date" id="ngaysinh" name="birthday" value="{{Auth::user()->birthday}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label style="margin-right: 30px;">Giới tính:</label>
                    <div class="custom-control custom-radio custom-control-inline" id="gioitinh">
                      <input type="radio" class="custom-control-input" id="customRadio1" name="gender" value="1" @if(Auth::user()->gender == 1) checked @endif>
                      <label class="custom-control-label" for="customRadio1" style="padding-top: 5px">Nam</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" class="custom-control-input" id="customRadio2" name="gender" value="0" @if(Auth::user()->gender == 0) checked @endif>
                      <label class="custom-control-label" for="customRadio2" style="padding-top: 5px">Nữ</label>
                    </div>
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


