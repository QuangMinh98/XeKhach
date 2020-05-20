@extends('admin1.master.header')

@section('noidung')

        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Danh Sách Tỉnh Thành</h6>
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
              <button class="btn btn-success" style="width: 180px;" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus-circle"></i> Thêm tỉnh thành</button>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Tên Tỉnh Thành</th>
                      <th>Thao Tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($tinh as $list)
                    <tr>
                      <td>{{$list->id}}</td>
                      <td>{{$list->tentinh}}</td>
                      <td>
                        <a href="#" class="btn btn-info btn-circle edit" data-toggle="modal" data-target="#editModal" data-id = "{{$list->id}}" data-name="{{$list->tentinh}}">
                          <i class="fas fa-info-circle"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-circle delete" data-id = "{{$list->id}}">
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
        <div class="modal fade" id="myModal">
          <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Thêm Tỉnh Thành</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <form action="{{route('addtinh')}}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label for="name">Tên Tỉnh Thành</label>
                    <input type="text" name="name" class="form-control">
                  </div>
                  <button type="submit" class="btn btn-success" style="width: 120px;">Thêm</button>
                </form>
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>

            </div>
          </div>
        </div>
        <div class="modal fade" id="editModal">
          <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Chỉnh Sửa Tỉnh Thành</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <form action="{{route('editTinh')}}" method="POST">
                  @csrf
                  <input type="hidden" name="id" id="edit-id">
                  <div class="form-group">
                    <label for="name">Tên Tỉnh Thành</label>
                    <input type="text" name="name" class="form-control" id="edit-name">
                  </div>
                  <button type="submit" class="btn btn-success" style="width: 120px;">Sửa</button>
                </form>
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>

            </div>
          </div>
        </div>
        
        <!-- /.container-fluid -->

@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function(){
    $(".edit").click(function(){
      id = $(this).data('id');
      name = $(this).data('name');
      $('#edit-id').val(id);
      $('#edit-name').val(name);
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