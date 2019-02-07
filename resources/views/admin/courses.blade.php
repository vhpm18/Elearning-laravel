@extends('layouts.app')
@section('jumbotron')
@include('partials.jumbotron',
	['title' => __("Administrar cursos"), 'icon'=> 'unlock-alt'])
@endsection
@section('content')
<div class="pr-5 pl-5">
	<couses-list
	:labels="{{ json_encode([
			'name' => __("Nombre"),
			'status' => __("Estado"),
			'activate_deactivate' => __("Activar / Desactivar"),
			'approve' =>_("Aprobar"),
			'reject' =>_("Rechazar")
			]) }}"
	route="{{ route('admin.courses_json') }}"
	>

	</couses-list>
</div>
@endsection
