<li class="nav-item">
	<a class="nav-link" href="{{ route('admin.courses') }}">{{ __('Administrar cursos') }}</a>
</li>
<li class="nav-item">
	<a class="nav-link" href="#">{{ __('Administrar estudiantes') }}</a>
</li>
<li class="nav-item">
	<a class="nav-link" href="#">{{ __('Administrar profesores') }}</a>
</li>
<li class="nav-item">
	<a class="nav-link" href="{{ route('courses.subscribed') }}">{{ __('Mis cursos') }}</a>
</li>
@include('partials.navigations.logged')
