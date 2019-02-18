@extends('layouts.app')
@section('jumbotron')
@include('partials.jumbotron',
	[
		'title' => __("Manejar mis facturas"),
		'icon'=> 'archive'
	]
	)
	@endsection
	@section('content')
	<div class="pr-5 pl-5">
		<div class="row justify-content-center">
			<table class="table table-bordered table-hover table-striped  table-light">
				<thead>
					<tr>
						<th>{{ __("Fecha de la suscripción") }}</th>
						<th>{{ __("Coste de la suscripción") }}</th>
						<th>{{ __("Cupón") }}</th>
						<th>{{ __("Descargar factura") }}</th>
					</tr>
				</thead>
				<tbody>
					@forelse($invoices as $invoice)
					<tr>
						<td>{{ $invoice->data()->format('d/m/Y') }}</td>
						<td>{{ $invoice->total() }}</td>
						@if($invoice->hasDiscount())
						<td>{{ __("Cupón :") }} ({{ $invoice->coupon() }} / {{ $invoice->discount() }})  </td>
						@else
						<td>{{ __("No se ha utilizado ningún cupón") }}</td>
						@endif
						<td>
							<a href="{{ route('invoices.download',['id' => $invoice->id]) }}" class="btn btn-course">
								{{ __("Descargar") }}
							</a>
						</td>
					</tr>
					@empty
					<tr>
						<td colspan="4">
							<div class="alert alert-dark text-center">{{ __("Todavía no tienes factuas") }}
							</div>	</td>
					</tr>

					@endforelse
				</tbody>
			</table>
		</div>
	</div>
	@endsection
