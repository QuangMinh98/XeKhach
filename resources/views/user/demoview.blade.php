<form action="{{route('demoSearch')}}" method="get">
	<select name="noidi">
		@foreach($tinh as $t)
		<option value="{{$t->id}}">{{$t->tentinh}}</option>
		@endforeach
	</select>
	<select name="noiden">
		@foreach($tinh as $t)
		<option value="{{$t->id}}">{{$t->tentinh}}</option>
		@endforeach
	</select>
	<input type="date" name="ngaydi">
	<input type="submit" name="">
</form>
@if(Auth::check())
<p>{{Auth::user()->name}}</p>
@else
<a href="{{route('login')}}">Đăng Nhập</a>
@endif

@if(isset($chuyen))
	@foreach($chuyen as $ds)
	<p>{{$ds->tenxe}}--{{$ds->biensoxe}}</p>
	<p>{{$ds->tenhang}}</p>
	<p>{{$ds->tentuyen}}</p>
	<p>{{$ds->giodi}}</p>
	<p>{{$ds->gioden}}</p>
	<p>{{$ds->noidi}}-{{$ds->tentinhdi}}</p>
	<p>{{$ds->noiden}}-{{$ds->tentinhden}}</p>
	<a href="{{route('demochitiet',['id'=>$ds->id])}}">Chi Tiết</a>
	<hr>
	@endforeach
@endif