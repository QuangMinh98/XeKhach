@extends('admin1.master.header')

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
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tên Xe</th>
                      <th>Tuyến Xe</th>
                      <th>Biển Số</th>
                      <th>Hoạt Động</th>
                      <th>Chi Tiết</th>
                      <th>Thao Tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($xe as $ds)
                    <tr>
                      <td>{{$ds->tenxe}}</td>
                      <td>{{$ds->tentuyen}}</td>
                      <td>{{$ds->biensoxe}}</td>
                      <td>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" data-id="{{$ds->idXe}}" id="{{$ds->idXe}}" name="{{$ds->idXe}}" @if($ds->tinhtrang == 'Hoạt Động') checked @endif>
                          <label class="custom-control-label" for="{{$ds->idXe}}"></label>
                        </div>
                      </td>
                      <td><a href="{{route('detailxe',['id'=>$ds->idXe])}}" class="badge badge-info">Chi Tiết</a></td>
                      <td>
                        <a href="{{route('showeditxe',['id'=>$ds->idXe])}}" class="btn btn-info btn-circle edit">
                          <i class="fas fa-info-circle"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-circle delete" data-id = "{{$ds->idXe}}">
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
        $.post('{{route('delXe')}}',{id:id,_token:"{{csrf_token()}}"}).done(function(){
          location.reload();
        }).fail(function(){
          alert('Không thể hoàn thành thao tác này');
        })
      }
    })
    $('.custom-control-input').click(function(){
      var id = $(this).data('id');
      var status ="Hoạt Động";
      if($(this).prop('checked')){
        status = "Hoạt Động";
      }
      else{
        status = "Không Hoạt Động";
      }
      $.ajax({
          url: '{{route('statusXe')}}',
          type: 'POST',
          data:{id:id,status:status,_token:"{{csrf_token()}}"},
          error:function(){
            alert('không thể hoàn thành thao tác')
          }
      })
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