@extends('admin1.master.header')

@section('noidung')

        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->

          <!-- DataTales Example -->
          <div class="card shadow md-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Chỉnh sửa thông tin xe</h6>
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
              <form action="{{route('editxe')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$xe->id}}">
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="idtuyen">Tuyến Xe Chạy:</label>
                      <select name="idtuyen" class="form-control">
                        @foreach($tuyen as $t)
                        @if($t->id == $xe->idtuyen)
                        <option value="{{$t->id}}" selected>{{$t->tentuyen}}</option>
                        @else
                        <option value="{{$t->id}}">{{$t->tentuyen}}</option>
                        @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="idloaixe">Loại Xe:</label>
                      <select name="idloaixe" class="form-control">
                        @foreach($loaixe as $lx)
                        @if($lx->id == $xe->idloaixe)
                        <option value="{{$lx->id}}" selected>{{$lx->tenloaixe}}</option>
                        @else
                        <option value="{{$lx->id}}">{{$lx->tenloaixe}}</option>
                        @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="name">Tên Xe:</label>
                      <input type="text" name="name" class="form-control" value="{{$xe->tenxe}}">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="mauxe">Mẫu Xe:</label>
                      <input type="text" name="mauxe" class="form-control" value="{{$xe->mauxe}}">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="bienso">Biển Số Xe</label>
                      <input type="text" name="bienso" class="form-control" value="{{$xe->biensoxe}}">
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="upload">Ảnh</label>
                      <input type="file" name="upload" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="sotang">Số Tầng</label>
                      <input type="number" name="sotang" class="form-control" min="1" max="4" value="{{$xe->sotang}}">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="soghe">Số Ghế</label>
                      <input type="number" name="soghe" class="form-control" min="5" value="{{$xe->soghe}}">
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-4">
                    <input type="hidden" name="lotrinhdi" value="{{$lotrinhdi->id}}">
                    <div class="form-group">
                      <label for="tinhdi">Tỉnh thành đi</label>
                      <select name="tinhdi" class="form-control">
                        @foreach($tinh as $tinhdi)
                        @if($lotrinhdi->idTinhDi == $tinhdi->id)
                        <option value="{{$tinhdi->id}}" selected="">{{$tinhdi->tentinh}}</option>
                        @else
                        <option value="{{$tinhdi->id}}">{{$tinhdi->tentinh}}</option>
                        @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="noidi">Địa điểm đi:</label>
                      <input type="text" name="noidi" class="form-control" value="{{$lotrinhdi->noidi}}">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="khoangcach">Khoảng Cách (Kilomete):</label>
                      <input type="number" name="khoangcach" class="form-control" value="{{$lotrinhdi->khoangcach}}">
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-4">
                    <input type="hidden" name="lotrinhve" value="{{$lotrinhve->id}}">
                    <div class="form-group">
                      <label for="tinhden">Tỉnh thành đến:</label>
                      <select name="tinhden" class="form-control">
                        @foreach($tinh as $tinhden)
                        @if($lotrinhdi->idTinhDen == $tinhden->id)
                        <option value="{{$tinhden->id}}" selected="">{{$tinhden->tentinh}}</option>
                        @else
                        <option value="{{$tinhden->id}}">{{$tinhden->tentinh}}</option>
                        @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="noiden">Địa điểm đến:</label>
                      <input type="text" name="noiden" class="form-control" value="{{$lotrinhdi->noiden}}">
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="mota">Mô Tả:</label>
                      <textarea name="mota" class="form-control">{{$xe->mota}}</textarea>
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-2 col-6">
                    <button type="submit" class="btn btn-success" style="width: 100%">Sửa</button>
                  </div>
                  <div class="col-md-2 col-6">
                    <a href="{{route('xe')}}"><button type="button" class="btn btn-danger" style="width: 100%">Hủy</button></a>
                  </div>
                </div>
              </form>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

@endsection
