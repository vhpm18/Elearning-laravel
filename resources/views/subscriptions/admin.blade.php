@extends('layouts.app')
@section('jumbotron')
@include('partials.jumbotron',
	[
		'title' => __("Manejar mis suscripciones"),
		'icon'=> 'list-ol'
		])
@endsection
@section('content')
<div class="pl-5 pr-5">
<div class="row justify-content-around">
<table class="table table-bordered table-hover table-striped  table-light">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Nombre</th>
			<th scope="col">Plan</th>
			<th scope="col">ID Suscripción</th>
			<th scope="col">Cantidad</th>
			<th scope="col">Alta</th>
			<th scope="col">Finaliza en</th>
			<th scope="col">Cancelar / Reanudar</th>

		</tr>
	</thead>
	<tbody>
		@forelse($subscriptions as $sudscripcion)
		<tr>
			<td>{{ $sudscripcion->id }}</td>
			<td>{{ $sudscripcion->name }}</td>
			<td>{{ $sudscripcion->stripe_pan }}</td>
			<td>{{ $sudscripcion->stripe_id }}</td>
			<td>{{ $sudscripcion->quantity }}</td>
			<td>{{ $sudscripcion->created_at->format('d/m/Y') }}</td>
			<td>{{ $sudscripcion->ends_at ? $sudscripcion->ends_at->format('d/m/Y') : __("Suscripción activa")}}</td>
			<td>
				@if($sudscripcion->ends_at)
					@include('partials.subscriptions.form',
					[
						'name' => __("Reanudar"), 'action' => 'resume', 'tipo' => 'success'
					])
				@else
					@include('partials.subscriptions.form',
						[
							'name' => __("Cancelar"),'action' => 'cancel', 'tipo' => 'danger'
						])
				@endif
			</td>
		</tr>
		@empty
		<tr>
			<td colspan="8" class="text-center">{{ __("No tiene ninguna suscripción activa") }}</td>
		</tr>
		<tr>
			<td colspan="8" class="text-center">{{ __("No tiene ninguna suscripción activa") }}</td>
		</tr>
		<tr>
			<td colspan="8" class="text-center">{{ __("No tiene ninguna suscripción activa") }}</td>
		</tr>
		<tr>
			<td colspan="8" class="text-center">{{ __("No tiene ninguna suscripción activa") }}</td>
		</tr>
		@endforelse
	</tbody>
</table>
</div>
</div>
@endsection
