<form action="{{ route('subscriptions.'.$action) }}" method="POST">
	@csrf
	<input type="hidden" name="plan" value="{{ $sudscripcion->name }}">
	<button class="btn btn-{{ $tipo }}">{{ $name }}</button>
</form>
