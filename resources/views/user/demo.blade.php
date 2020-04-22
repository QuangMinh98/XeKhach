<form action="{{route('demologin')}}" method="post">
	@csrf
	<input type="text" name="email">
	<input type="password" name="password">
	<input type="submit" name="">
</form>