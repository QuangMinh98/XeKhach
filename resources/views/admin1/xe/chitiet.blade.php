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
              <div class="row">
                <div class="col-md-6">
                  <div class="panel">
                    <p class="text-center text-uppercase text-primary">Thông tin xe</p>
                    <table class="table">
                      <tbody>
                        <tr>
                          <td><p><strong>Tên xe:</strong><span>&nbsp{{$xe->tenxe}}</span></p></td>
                        </tr>
                        <tr>
                          <td><p><strong>Biển Số:</strong><span>&nbsp{{$xe->biensoxe}}</span></p></td>
                        </tr>
                        <tr>
                          <td><p><strong>Tuyến Xe:</strong><span>&nbsp{{$tuyen->tentuyen}}</span></p></td>
                        </tr>
                        <tr>
                          <td><p><strong>Số Tầng:</strong><span>&nbsp{{$xe->sotang}}</span></p></td>
                        </tr>
                        <tr>
                          <td><p><strong>Số Ghế:</strong><span>&nbsp{{$xe->soghe}}</span></p></td>
                        </tr>
                        <tr>
                          <td>
                            <p><strong>Tình Trạng:</strong>
                              @if($xe->tinhtrang == 'Hoạt Động')
                              <span class="badge badge-primary">Hoạt Động</span>
                              @else
                              <span class="badge badge-danger">Không Hoạt Động</span>
                              @endif
                            </p>
                          </td>
                        </tr>
                        <tr>
                          <td><p><strong>Lộ Trình:</strong><span>&nbsp{{$lotrinh->noidi}}--{{$lotrinh->tentinhdi}}  <i style="padding: 0px 20px;" class="fas fa-exchange-alt"></i>  {{$lotrinh->noiden}}--{{$lotrinh->tentinhden}}</span></p></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="panel">
                    <p class="text-center text-uppercase text-primary">Ghế Ngồi</p>
                    <input type="hidden" name="id" id="id" value="{{$xe->id}}">
                    <div class="form-group">
                      <label for="tang">Tầng:</label>
                      <select id="tang" name="tang" class="form-control form-control-sm">
                        @for($i = 1 ; $i<=$xe->sotang ; $i++)
                        <option value="{{$i}}">Tầng {{$i}}</option>
                        @endfor
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="from">Số Ghế Bắt Đầu:</label>
                      <select id="from" name="from" class="form-control form-control-sm">
                        @foreach($ghe as $seat)
                        <option value="{{$seat->soghe}}">{{$seat->soghe}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="to">Số Ghế Kết Thúc:</label>
                      <select id="to" name="to" class="form-control form-control-sm">
                        @foreach($ghe as $seat)
                        <option value="{{$seat->soghe}}">{{$seat->soghe}}</option>
                        @endforeach
                      </select>
                    </div>
                    <button id="save" class="btn btn-primary">Lưu</button>
                  </div>
                  <div class="panel">
                    <p class="text-center text-uppercase text-primary">Sơ Đồ Ghế</p>
                    <div class="row">
                      @for($i=1 ; $i<=$xe->sotang ; $i++)
                      <div class="col-md-6">
                        <dt style="text-align: center;">Tầng {{$i}}</dt>
                        <div class="row" style="margin: 0;">
                          @foreach($ghe as $seat)
                          @if($seat->sotang == $i)
                          <div class="col-md-3 col-3">
                            <span class="seat">{{$seat->soghe}}</span>
                          </div>
                          @endif
                          @endforeach
                        </div>
                      </div>
                      @endfor
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

@endsection

@section('style')
<style type="text/css">
  .data{
    overflow-x: hidden;
    height: 93%;
  }
  .table{
    background: unset;
  }
  .seat{
    height: 28px;
    width: 35px;
    color: #999;
    cursor: pointer;
    border: 1px solid #424242;
    border-radius: 3px;
    padding: 5px 10px;
    background: #2b2b2b;
    margin: 2px 4px 2px 2px;
    display: inline-block;
    font-weight: 700;
    font-size: 11px;
    text-align: center;
  }
  .horizontal{
    float: left;
  }

</style>

@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function(){
    $('#save').click(function(){
      var id = $('#id').val();
      var tang = $('#tang').val();
      var from = $('#from').val();
      var to = $('#to').val();
      $.ajax({
        url: '{{route('editSeat')}}',
        type: 'get',
        data: {id:id,tang:tang,from:from,to:to},
        success:function(d){
          alert(d);
          location.reload();
        },
        error:function(){
          alert('Không thể hoàn thành thao tác');
        }
      })
    })
  })
</script>
@endsection
