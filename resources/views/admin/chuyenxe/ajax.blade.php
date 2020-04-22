@if(isset($xe))
	@foreach($xe as $x)
	<option value="{{$x->id}}">{{$x->tenxe}}-{{$x->biensoxe}}</option>
	@endforeach
@endif
@if(isset($lotrinh))
	@foreach($lotrinh as $lt)
	<option value="{{$lt->id}}">
		{{$lt->noidi}}-{{$lt->tentinhdi}} &nbsp -> &nbsp {{$lt->noiden}}-{{$lt->tentinhden}}
	</option>
	@endforeach
@endif