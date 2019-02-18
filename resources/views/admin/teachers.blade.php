@extends('layouts.app')
@section('jumbotron')
@include('partials.jumbotron',
	['title' => __("Administrar profesores"), 'icon'=> 'unlock-alt'])
@endsection
@section('content')
<div class="pr-5 pl-5">
	<teachers-list
	:labels="{{
		json_encode([
		'picture' => __("Foto"),
		'name' => __("Nombre"),
		'email' => __("Email"),
		'created_at' => __("Registro"),
		'message' => __("Enviar Mensaje")
		])
	 }}"
	 route="{{ route('admin.teachers_json') }}"
	></teachers-list>
</div>
@endsection
