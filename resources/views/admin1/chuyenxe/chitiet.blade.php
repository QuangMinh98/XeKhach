@extends('admin1.master.header')

@section('noidung')

        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->

          <!-- DataTales Example -->
          <div class="card shadow md-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Thông tin chuyến xe</h6>
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
                    <p class="text-center text-uppercase text-primary">Thông tin chuyến xe</p>
                    <table class="table">
                      <tbody>
                        <input type="hidden" name="id" id="id" value="{{$chuyen->id}}">
                        <tr>
                          <td><p><strong>Tên xe:</strong><span>&nbsp{{$xe->tenxe}}</span></p></td>
                        </tr>
                        <tr>
                          <td><p><strong>Biển Số:</strong><span>&nbsp{{$xe->biensoxe}}</span></p></td>
                        </tr>
                        <tr>
                          <td><p><strong>Tuyến Xe:</strong><span>&nbsp{{$chuyen->tentuyen}}</span></p></td>
                        </tr>
                        <tr>
                          <td><p><strong>Thời Gian:</strong><span>&nbsp{{$chuyen->giodi}}  <i style="padding: 0px 20px;" class="fas fa-arrow-right"></i>  {{$chuyen->gioden}}</span></p></td>
                        </tr>
                        <tr>
                          <td><p><strong>Số Ghế Trống:</strong><span>&nbsp{{$xe->soghe - $sove}}</span></p></td>
                        </tr>
                        <tr>
                          <td>
                            <p><strong>Tình Trạng:</strong>
                            </p>
                            <select id="status" class="form-control form-control-sm">
                              <option value="0" @if($chuyen->tinhtrang == 0) selected  @endif>Sẵn Sàng</option>
                              <option value="1" @if($chuyen->tinhtrang == 1) selected  @endif>Đang di chuyển</option>
                              <option value="2" @if($chuyen->tinhtrang == 2) selected  @endif>Đã hoàn thành</option>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td><p><strong>Lộ Trình:</strong><span>&nbsp &nbsp{{$chuyen->noidi}}--{{$chuyen->tentinhdi}}  <i style="padding: 0px 20px;" class="fas fa-arrow-right"></i>  {{$chuyen->noiden}}--{{$chuyen->tentinhden}}</span></p></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-6">
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
                            @if(in_array($seat->soghe,$ve))
                            <span class="seat">{{$seat->soghe}}</span>
                            @else
                            <span id="seat" class="seat non-choose" href="">{{$seat->soghe}}</span>
                            @endif
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
  .seat{
    height: 28px;
    width: 35px;
    color: #fff;
    cursor: pointer;
    border: 1px solid #424242;
    border-radius: 3px;
    background: #F42536;
    padding: 5px 10px;
    margin: 2px 4px 2px 2px;
    display: inline-block;
    font-weight: 700;
    font-size: 11px;
    text-align: center;
  }
  .non-choose{
    background: #2b2b2b;
    color: #fff;
  }

  .menu{
    width: 85px;
  }

  .menu.active{
    width: 538px;
  }

</style>
@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function(){
    $('#status').change(function(){
      id = $('#id').val();
      status = $('#status').val();
      $.ajax({
        url: '{{route('changeStatus')}}',
        type: 'get',
        data: {id:id,status:status},
        error:function(){
          alert('Không thể hoàn thành thao tác');
        }
      })
    })
  })
</script>
@endsection
