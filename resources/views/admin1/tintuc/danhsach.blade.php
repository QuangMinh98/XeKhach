@extends('admin1.master.header')

@section('title')
Danh sách tin tức
@endsection

@section('noidung')

        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Danh Sách Tin Tức</h6>
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
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Ảnh</th>
                      <th>Tiêu Đề</th>
                      <th>Ngày Đăng</th>
                      <th>Thao Tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($tintuc as $ds)
                    <tr>
                      <td>{{$ds->id}}</td>
                      <td><img src="{{asset($ds->img)}}" style="width: 120px; height: 50px;"></td>
                      <td>{{$ds->tieude}}</td>
                      <td>{{date('d-m-yy G:i',strtotime($ds->created_at)+7*60*60)}}</td>
                      <td>
                        <a href="{{route('showEditTin',['id'=>$ds->id])}}" class="btn btn-info btn-circle edit">
                          <i class="fas fa-info-circle"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-circle delete" data-id = "{{$ds->id}}">
                          <i class="fas fa-trash"></i>
                        </a>
                      </td>
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
  $(document).ready(function(){
    $(".delete").click(function(){
      id = $(this).data('id');
      if (confirm("Dữ liệu xoá sẽ không khôi phục được. Bạn có thật sự muốn xoá?")) {
        $.post('{{route('delTin')}}',{id:id,_token:"{{csrf_token()}}"}).done(function(){
          location.reload();
        }).fail(function(){
          alert('Không thể hoàn thành thao tác này');
        })
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
    text-align: right;
  }
</style>
@endsection