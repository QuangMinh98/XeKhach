@extends('admin1.master.header')

@section('title')
Quản lý vé xe
@endsection

@section('noidung')

        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Danh Sách Xe</h6>
            </div>
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
            <div class="top">
              <div class="row">
                <div class="col-md-4">
                  <form action="{{route('ve')}}" method="GET">
                    <div class="form-group">
                      <label for="sort">Tình Trạng:</label>
                      <select onchange="this.form.submit()" name="sort" class="form-control">
                        <option value="-1" @if(isset($sort) and $sort==0)selected @endif>Tất Cả</option>
                        <option value="0" @if(isset($sort) and $sort==0)selected @endif>Đã Đặt</option>
                        <option value="1" @if(isset($sort) and $sort==1)selected @endif>Đã Tiếp Nhận</option>
                        <option value="2" @if(isset($sort) and $sort==2)selected @endif>Đã Hoàn Thành</option>
                        <option value="3" @if(isset($sort) and $sort==3)selected @endif>Đã Hủy</option>
                      </select>
                    </div>
                  </form>
                </div>
                <div class="col-md-4">
                  <form action="{{route('ve')}}" method="GET">
                    <div class="form-group">
                      <label for="search">Tìm kiếm mã vé:</label>
                      <input type="search" name="search" class="form-control" id="search">
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Tình Trạng</th>
                      <th>Thanh Toán</th>
                      <th>Ngày Đặt</th>
                      <th>Chi Tiết</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($ve as $ds)
                    <tr>
                      <td>{{$ds->id}}</td>
                        @switch($ds->tinhtrang)
                          @case (0)
                          <td><a href="javascript:" data-id="{{$ds->id}}" class="badge badge-primary receive" href="">Đã Đặt</a></td>
                          @break
                          @case (1)
                          <td><a href="javascript:" data-id="{{$ds->id}}" class="badge badge-info received">Đã Tiếp Nhận</a></td>
                          @break
                          @case (2)
                          <td><span class="badge badge-success">Đã Hoàn Thành</span></td>
                          @break
                          @case (3)
                          <td><span class="badge badge-danger">Đã Hủy</span></td>
                          @break
                        @endswitch
                        <td>
                          @if($ds->tinhtrang == 2 || $ds->tinhtrang ==3)
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" data-id="{{$ds->id}}" id="{{$ds->id}}" name="{{$ds->id}}" @if($ds->thanhtoan == 1) checked @endif disabled>
                            <label class="custom-control-label" for="{{$ds->id}}"></label>
                          </div>
                          @else
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" data-id="{{$ds->id}}" id="{{$ds->id}}" name="{{$ds->id}}" @if($ds->thanhtoan == 1) checked @endif>
                            <label class="custom-control-label" for="{{$ds->id}}"></label>
                          </div>
                          @endif
                        </td>
                        <td> {{date('d-m-yy G:i',strtotime($ds->created_at)+7*60*60)}}</td>
                        <td><a href="{{route('chitietve',['id'=>$ds->id])}}" class="badge badge-info">Chi Tiết</a></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

@endsection

@section('script')
<script type="text/javascript">
  $('.custom-control-input').click(function(){
    var id = $(this).data('id');
    var thanhtoan =0;
    if($(this).prop('checked')){
      thanhtoan = 1;
    }
    else{
      thanhtoan = 0;    }
    $.ajax({
        url: '{{route('thanhtoan')}}',
        type: 'POST',
        data:{id:id,thanhtoan:thanhtoan,_token:"{{csrf_token()}}"},
        error:function(){
          alert('không thể hoàn thành thao tác')
        }
    })
  })
</script>
@endsection

@section('style')
<style type="text/css">
  .top{
    padding-top: 20px;
    padding-left: 20px;
    padding-right: 20px;
    width: 100%;
    text-align: left;
  }
</style>
@endsection