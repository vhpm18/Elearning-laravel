@extends('layouts.app')
@push('styles')
	<link rel="stylesheet" href="{{ asset('css/pricing.css') }}" type="text/css">
@endpush
@section('jumbotron')
@include('partials.jumbotron',
	[
		'title' => __("Subscríbete ahora a uno de nuestros planes"),
		'icon'=> 'globe'
		])
@endsection
@section('content')
		<div class="container">
			<div class="pricing-table pricing-three-column row">
				<div class="plan col-sm-4 col-lg-4">
					<div class="plan-name-bronze">
						<h2>{{ __("Mensual") }}</h2>
						<span>{{ __(":price / Mes", ['price' => '$ 9,99']) }}</span>
					</div>
					<ul>
						<li class="plan-feature">{{ __("Acceso a todos los cursos") }}</li>
						<li class="plan-feature">{{ __("Acceso a todos los archivos") }}</li>
						<li class="plan-feature">
							@include('partials.stripe.form',[
								"product"=>
								[
									"name" => __("Suscripción"),
									"description" => __("Mensual"),
									"type"=>"monthly",
									"amount"=>999,99
								]
								])
							</li>
					</ul>
				</div>
				<div class="plan col-sm-4 col-lg-4">
					<div class="plan-name-silver">
						<h2>{{ __("Trimestal") }}</h2>
						<span>{{ __(":price / 3 Meses", ['price' => '$ 19,99']) }}</span>
					</div>
					<ul>
						<li class="plan-feature">{{ __("Acceso a todos los cursos") }}</li>
						<li class="plan-feature">{{ __("Acceso a todos los archivos") }}</li>
						<li class="plan-feature">
							@include('partials.stripe.form',[
								"product"=>
								[
									"name" => __("Suscripción"),
									"description" => __("Trimestral"),
									"type"=>"quarterly",
									"amount"=>1999,99
								]
								])
							</li>
					</ul>
				</div>
				<div class="plan col-sm-4 col-lg-4">
					<div class="plan-name-gold">
						<h2>{{ __("Anual") }}</h2>
						<span>{{ __(":price / 12 Meses", ['price' => '$ 89,99']) }}</span>
					</div>
					<ul>
						<li class="plan-feature">{{ __("Acceso a todos los cursos") }}</li>
						<li class="plan-feature">{{ __("Acceso a todos los archivos") }}</li>
						<li class="plan-feature">
							@include('partials.stripe.form',[
								"product"=>
								[
									"name" => __("Suscripción"),
									"description" => __("Anual"),
									"type"=>"yearly",
									"amount"=>8999,99
								]
								])
							</li>
					</ul>
				</div>
			</div>

		</div>
@endsection
