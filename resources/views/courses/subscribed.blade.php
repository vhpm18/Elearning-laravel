@extends('layouts.app')
@section('jumbotron')
@include('partials.jumbotron',
	[
		'title' => __("Cursos a los que está suscrito"),
		'icon'=> 'table'
		])
		@endsection
		@section('content')
		<div class="pr-5 pl-5">
			<div class="row justify-content-center">
				@forelse($courses as $course)
				<div class="col-md-3">
					@include('partials.courses.card_course')
				</div>
				@empty
				<div class="alert alert-dark">{{ __("Todavía no está suscrito a ningun curso") }}</div>
				@endforelse
			</div>
		</div>
		@endsection
