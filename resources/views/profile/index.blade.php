@extends('layouts.app')
@section('jumbotron')
@include('partials.jumbotron',
	[
		'title' => __("Configurar tu perfil"),
		'icon'=> 'user-circle'
	]
	)
	@endsection
	@push('styles')
	<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}" type="text/css">
	@endpush
	@section('content')
	<div class="pr-5 pl-5">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						{{ __("Actualiza tus datos") }}
					</div>
					<div class="card-body">
						<form action="{{ route('profile.update') }}" method="POST" novalidate>
							@csrf
							@method('PUT')
							<div class="form-group row">
								<label for="email" class="col-md-4 col-form-label text-md-rigth">
									{{ __("Correo electrónico") }}
								</label>
								<div class="col-md-6">
									<input
									id="email"
									type="email"
									readonly
									class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
									name="email"
									value="{{ old('email') ?:$user->email }}"
									required
									autofocus
									/>
									@if($errors->has('email'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
									@endif
								</div>
							</div>
							<div class="form-group row">
								<label for="password" class="col-md-4 col-form-label text-md-rigth">
									{{ __("Contraseña") }}
								</label>
								<div class="col-md-6">
									<input
									id="password"
									type="password"
									class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
									name="password"
									required="required"
									value=""
									/>
									@if($errors->has('password'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('password') }}</strong>
									</span>
									@endif
								</div>
							</div>
							<div class="form-group row">
								<label for="password-confirm" class="col-md-4 col-form-label text-md-rigth">
									{{ __("Confirma la contraseña") }}
								</label>
								<div class="col-md-6">
									<input
									id="password-confirm"
									type="password"
									class="form-control"
									name="password_confirmation"
									required
									/>
								</div>
							</div>
							<div class="row form-group mb-0">
								<div class="col-md-8 offset-md-4">
									<button class="btn btn-primary" type="submit">
										{{ __("Actualizar datos") }}
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			@if(!$user->teacher)
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						{{ __("Convertime en profesor de la plataforma") }}
					</div>
					<div class="card-body">
						<form action="{{ route('solicitude.teacher') }}" method="POST">
							@csrf
							<button type="submit" class="btn btn-outline-primary btn-block">
								<i class="fa fa-graduation-cap"></i>{{ __("Solicitar") }}
							</button>
						</form>
					</div>
				</div>
			</div>
			@else
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						{{ __("Administrar los cursos que imparto") }}
					</div>
					<div class="card-body">
						<a href="{{ route('teacher.courses') }}" class="btn btn-secondary btn-block">
							<i class="fa fa-leanpub"></i> {{ __("Administrar ahora") }}
						</a>
					</div>
				</div>

				@if($user->socialAccount)
				<div class="card">
					<div class="card-header">
						{{ __("Acceso con Socialite") }}
					</div>
					<div class="card-body">
						<button  class="btn btn-secondary btn-block">
							{{ __("Registrado con") }}: <i class="fa fa-{{ $user->socialAccount->provider }}"></i>
							{{  $user->socialAccount->provider }}
						</button>
					</div>
				</div>
				@endif
			</div>
			<div class="col-md-10">
				<div class="card">
					<div class="header">{{ __("Mis estudiantes") }}</div>
					<div class="card-body">
						<table
						id="students-table"
						class="table table-striped table-bordered flex-nowrap"
						cellpadding="0">
						<thead>
							<tr>
								<th>{{ __("ID") }}</th>
								<th>{{ __("Nombre") }}</th>
								<th>{{ __("Email") }}</th>
								<th>{{ __("Curso") }}</th>
								<th>{{ __("Acciones") }}</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		@endif
	</div>
</div>
@include('partials.modal')
@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script>
	let dt;
	let modal = $("#appModal");
	$(document).ready(function(){
		dt = $("#students-table").DataTable({
			"pageLength": 5,
			"lengthMenu":[5,10,25,50,75,100],
			"processing": true,
			"serverSide": true,
			"ajax":'{{ route('teacher.students') }}',
			language:{
				url:"{{ asset('js/spanish.json') }}"
			},
			columns:[
			{data: 'user.id', visible:false},
			{data: 'user.name'},
			{data: 'user.email'},
			{data: 'courses_formatted'},
			{data: 'actions'},
			]
		})
		$(document).on("click", '.btnEmail', function(e){
			e.preventDefault();
			const id = $(this).data('id');
			modal.find('.modal-title').text('{{ __("Enviar mensaje") }}');
			modal.find('#modalAction').text('{{ __("Enviar mensaje") }}').show();
			let $form = $("<form id='studentMessage'></form>");
			$form.append(`<input type="hidden" name="user_id" value="${id}">`);
			$form.append(`<textarea class="form-control" name="message"></textarea>`);
			modal.find('.modal-body').html($form);
			modal.modal();
		});
		$(document).on("click", "#modalAction", function(e){
			e.preventDefault();
			modal.find('#modalAction').text('{{ __("Enviando mensaje...") }}').attr('disabled', 'disabled');
			jQuery.ajax({
				url: '{{ route('teacher.send_to_message_to_student') }}',
				type: 'POST',
				headers:{
					'x-csrf-token':$("meta[name=csrf-token]").attr('content')
				},
				data:{
					info: $("#studentMessage").serialize()
				},
				success: (res) => {
					if (res.res) {
						modal.find('#modalAction').hide();
						modal.find('.modal-body').html(`
							<div class="alert alert-success" >
							<strong>Información!</strong>
							{{ __("Mensaje enviado correctamente") }}
							</div>`);
					}else{
						modal.find('.modal-body').html(`
							<div class="alert alert-danger" >
							<strong>Información!</strong>
							{{ __("Ha ocurrido un error enviando el correo") }}
							</div>`);
					}
				}
			})
		})
	});
</script>
@endpush
