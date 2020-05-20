@extends('admin1.master.header')

@section('noidung')

        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->

          <!-- DataTales Example -->
          <div class="card shadow md-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Thêm Xe</h6>
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
            <div class="data-form">
              <form action="{{route('addchuyen')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="idtuyen">Tuyến Xe Chạy:</label>
                      <select id="tuyen" name="idtuyen" class="form-control">
                        @foreach($tuyen as $t)
                        <option value="{{$t->id}}">{{$t->tentuyen}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="idloaixe">Loại Xe:</label>
                      <select id="loaixe" name="idloaixe" class="form-control">
                        @foreach($loaixe as $lx)
                        <option value="{{$lx->id}}">{{$lx->tenloaixe}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="idXe">Xe:</label>
                      <select id="xe" name="idxe" class="form-control">
                        @foreach($xe as $x)
                        <option value="{{$x->id}}">{{$x->tenxe}}-{{$x->biensoxe}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="idlotrinh">Lộ Trình:</label>
                      <select id="lotrinh" name="idlotrinh" class="form-control">
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="ngaydi">Ngày Đi:</label>
                      <input type="datetime-local" name="ngaydi" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="ngayden">Ngày Đến:</label>
                      <input type="datetime-local" name="ngayden" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="giave">Giá Vé(VNĐ):</label>
                      <input type="number" name="giave" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-2 col-6">
                    <button type="submit" class="btn btn-success" style="width: 100%">Thêm</button>
                  </div>
                  <div class="col-md-2 col-6">
                    <a href="{{route('chuyenxe')}}"><button type="button" class="btn btn-danger" style="width: 100%">Hủy</button></a>
                  </div>
                </div>
              </form>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function(){
    $('#tuyen').change(function(){
      idLoaiXe = $('#loaixe').val();
      idTuyen = $('#tuyen').val();
      $.ajax({
        url:'{{route('ajaxxe')}}',
        type: 'get',
        data:{idTuyen:idTuyen,idLoaiXe:idLoaiXe},
        success:function(d){
          $('#xe').html(d);
        },
        error:function(){
          alert('Không thể hoàn thành thao tác');
        }
      })
    })
    $('#loaixe').change(function(){
      idLoaiXe = $('#loaixe').val();
      idTuyen = $('#tuyen').val();
      $.ajax({
        url:'{{route('ajaxxe')}}',
        type: 'get',
        data:{idTuyen:idTuyen,idLoaiXe:idLoaiXe},
        success:function(d){
          $('#xe').html(d);
        },
        error:function(){
          alert('Không thể hoàn thành thao tác');
        }
      })
    })
    $('#xe').click(function(){
      idXe = $('#xe').val();
      $.ajax({
        url:'{{route('ajaxlotrinh')}}',
        type: 'get',
        data:{idXe:idXe},
        success:function(d){
          $('#lotrinh').html(d);  
        },
        error:function(){
          alert('Không thể hoàn thành thao tác');
        }
      })
    })
  })
</script>
@endsection
