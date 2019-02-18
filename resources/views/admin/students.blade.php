@extends('layouts.app')
@section('jumbotron')
@include('partials.jumbotron',
	['title' => __("Administrar estudiantes"), 'icon'=> 'unlock-alt'])
@endsection
@section('content')
<div class="pr-5 pl-5">
	<students-list
	:labels="{{
		json_encode([
		'picture' => __("Foto"),
		'name' => __("Nombre"),
		'email' => __("Email"),
		'created_at' => __("Registro"),
		'message' => __("Enviar Mensaje")
		])
	 }}"
	 route="{{ route('admin.students_json') }}"
	>
</div>
@endsection
