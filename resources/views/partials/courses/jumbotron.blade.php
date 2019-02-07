<div class="jumbotron" style="background-image: url('{{ url('/images/jumbotron.png') }}')">
	<div class="text-white text-center d-flex align-items-center py-2 px-1 my-2">
		<div class="col-5">
			<img class="img-fluid" src="{{ $course->pathAttachment() }}">
		</div>
		<div class="col-5 text-left">
			<h2>{{ __("Curso") }}: {{ $course->name }}</h2>
			<h5>{{ __("Profesor") }}: {{ $course->teacher->user->name }}</h5>
			<h5>{{ __("Categoría") }}: {{ $course->category->name }}</h5>
			<h5>{{ __("Fecha de publicación") }}: {{ $course->created_at->format('d/m/Y') }}</h5>
			<h5>{{ __("Fecha de Actualización") }}: {{ $course->updated_at->format('d/m/Y') }}</h5>
			<h6>{{ __("Estudiantes Inscritos") }}: {{ $course->students_count }}</h6>
			<h6>{{ __("Número de valoraciones") }}: {{ $course->reviews_count }}</h6>
			@include('partials.courses.rating')
		</div>
		@include('partials.courses.acction_button')
	</div>
</div>
