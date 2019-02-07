<div class="btn-group">
	@if((int) $course->status === \App\Entities\Course::PUBLISHED)
		<a class="btn btn-course" href="{{ route('courses.detail',["slug" => $course->slug]) }}">
			<i class="fa fa-eye"></i> {{ __("Detalle") }}
		</a>
		<a class="btn btn-warning text-white" href="{{ route('courses.edit',["slug" => $course->slug]) }}">
			<i class="fa fa-pencil"></i> {{ __("Editar curso") }}
		</a>
		@include('partials.courses.btn_form.delete')
	@elseif((int) $course->status === \App\Entities\Course::PENDING)
		<a class="btn btn-primary text-white" href="#">
			<i class="fa fa-history"></i> {{ __("P Revisión") }}
		</a>
		<a class="btn btn-course" href="{{ route('courses.detail',["slug" => $course->slug]) }}">
				<i class="fa fa-eye"></i> {{ __("Detalle") }}
		</a>
		<a class="btn btn-warning text-white" href="{{ route('courses.edit',["slug" => $course->slug]) }}">
			<i class="fa fa-pencil"></i> {{ __("Editar curso") }}
		</a>
		@include('partials.courses.btn_form.delete')
	@else
		<a class="btn btn-danger text-white" href="#">
			<i class="fa fa-pause"></i> {{ __("Curso rechazado") }}
		</a>
		@include('partials.courses.btn_form.delete')
	@endif
</div>
