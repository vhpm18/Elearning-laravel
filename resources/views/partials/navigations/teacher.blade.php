@include('partials.navigations.teacher_student')
<li class="nav-item">
	<a class="nav-link" href="{{ route('teacher.courses') }}">{{ __('Cursos desarrollados por mí') }}</a>
</li>
<li class="nav-item">
	<a class="nav-link" href="{{ route('courses.create') }}">{{ __('Crear cursos') }}</a>
</li>
@include('partials.navigations.logged')
