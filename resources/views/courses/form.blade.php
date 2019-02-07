@extends('layouts.app')
@section('jumbotron')
@include('partials.jumbotron',
	[
		'title' => __("Dar de alta un nuevo curso"),
		'icon'=> 'edit'
		])
		@endsection
		@section('content')
		<div class="pr-5 pl-5">
			<form method="POST"
				action="{{ ! $course->id ? route('courses.store') : route('courses.update',['slug' => $course->slug]) }}"
				novalidate
				enctype="multipart/form-data">
				@csrf
				@if($course->id)
					@method('PUT')
				@endif
				<div class="row justify-content-center">
					<div class="col-md-8">
						<div class="card">
							<div class="card-header">{{ __("Información del curso") }}</div>
							<div class="card-body">
								<div class="form-group row">
									<label for="name" class="col-md-4 col-form-label text-md-right">
										{{ __("Nombre del curso") }}
									</label>
									<div class="col-md-6">
										<input
										name="name"
										id="name"
										class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
										value="{{ old('name') ?: $course->name }}"
										required
										autofocus
										/>
										@if($errors->has('name'))
										<span class="invalid-feedback">
											<strong>{{ $errors->first('name') }}</strong>
										</span>
										@endif
									</div>
								</div>
								<div class="form-group row">
									<label for="lavel_id" class="col-md-4 col-form-label text-md-right">
										{{ __("Nivel del curso") }}
									</label>
									<div class="col-md-6">
										<select name="level_id" id="level_id" class="form-control">
											@foreach(\App\Entities\Level::pluck('name','id') as $id => $level)
												<option {{ (int) old('level_id') === $id || $course->level_id === $id ? 'selected'  : ''}} value="{{ $id }}">
													{{ $level }}
												</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="category_id" class="col-md-4 col-form-label text-md-right">
										{{ __("Categoría del curso") }}
									</label>
									<div class="col-md-6">
										<select name="category_id" id="category_id" class="form-control">
											@foreach(\App\Entities\Category::groupBy('name')->pluck('name','id') as $id => $category)
												<option {{ (int) old('category_id') === $id || $course->category_id === $id ? 'selected'  : ''}} value="{{ $id }}">
													{{ $category }}
												</option>
											@endforeach
										</select>
									</div>
								</div>
								<hr/>
								<div class="form-group ml-3 mr-2">
									<div class="col-md-6 offset-4">
										<input
										type="file"
										name="picture"
										class="custom-file-input{{ $errors->has('picture') ? ' is-invalid' : '' }}"
										id="picture"
										/>
										<label class="custom-file-label" for="picture">
											{{ __("Escoge una imagen para tu curso") }}
										</label>
									</div>
								</div>
								<div class="form-group row">
									<label for="description" class="col-md-4 col-form-label text-md-right">
										{{ __("Descripción del curso") }}
									</label>
									<div class="col-md-6">
										<textarea
										id="description"
										class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
										name="description"
										required
										rows="8">
										{{ old('description') ?: $course->description }}
										</textarea>
										@if($errors->has('description'))
											<span class="invalid-feedback">
												<strong>{{ $errors->first('description') }}</strong>
											</span>
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="card">
							<div class="card-header">{{ __("Requisitos para tomar el curso") }}</div>
							<div class="card-body">
								<div class="form-group row">
									<label for="requirement1" class="col-md-4 col-form-label text-md-right">
										{{ __("Requerimineto 1") }}
									</label>
									<div class="col-md-6">
										<input
										id="requirement1"
										class="form-control{{ $errors->has('requirements.0') ? ' is-invalid' : ''}}"
										name="requirements[]"
										value="{{ old('requirements.0') ? old('requirements.0') :  ($course->requirements_count > 0 ? $course->requirements[0]->requirement : '')}}"/>
										@if($errors->has('requirements.0'))
										<span class="invalid-feedback">
											<strong>{{ $errors->first('requirements.0') }}</strong>
										</span>
										@endif
										@if($course->requirements_count > 0)
										<input type="hidden" name="requirement_id0" value="{{ $course->requirements[0]->id }}">
										@endif
									</div>
								</div>
								<div class="form-group row">
									<label for="requirement2" class="col-md-4 col-form-label text-md-right">
										{{ __("Requerimineto 2") }}
									</label>
									<div class="col-md-6">
										<input
										id="requirement2"
										class="form-control{{ $errors->has('requirements.1') ? ' is-invalid' : ''}}"
										name="requirements[]"
										value="{{ old('requirements.1') ? old('requirements.1') :  ($course->requirements_count > 1 ? $course->requirements[1]->requirement : '')}}"/>
										@if($errors->has('requirements.1'))
										<span class="invalid-feedback">
											<strong>{{ $errors->first('requirements.1') }}</strong>
										</span>
										@endif
										@if($course->requirements_count > 1)
										<input type="hidden" name="requirement_id1" value="{{ $course->requirements[1]->id }}">
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="card">
							<div class="card-header">{{ __("¿Qué conseguirá el estudiante al finalizar el curso?") }}</div>
							<div class="card-body">
								<div class="form-group row">
									<label for="goal1" class="col-md-4 col-form-label text-md-right">
										{{ __("Meta 1") }}
									</label>
									<div class="col-md-6">
										<input
										id="goal1"
										class="form-control{{ $errors->has('goal.0') ? ' is-invalid' : ''}}"
										name="goal[]"
										value="{{ old('goal.0') ? old('goal.0') :  ($course->goal_count > 0 ? $course->goal[0]->goal : '')}}"/>
										@if($errors->has('goal.0'))
										<span class="invalid-feedback">
											<strong>{{ $errors->first('goal.0') }}</strong>
										</span>
										@endif
										@if($course->goal_count > 0)
										<input type="hidden" name="goal_id0" value="{{ $course->goal[0]->id }}">
										@endif
									</div>
								</div>
								<div class="form-group row">
									<label for="goal2" class="col-md-4 col-form-label text-md-right">
										{{ __("Meta 2") }}
									</label>
									<div class="col-md-6">
										<input
										id="goal2"
										class="form-control{{ $errors->has('goal.1') ? ' is-invalid' : ''}}"
										name="goal[]"
										value="{{ old('goal.1') ? old('goal.1') :  ($course->goal_count > 1 ? $course->goal[1]->goal : '')}}"/>
										@if($errors->has('goal.1'))
										<span class="invalid-feedback">
											<strong>{{ $errors->first('goal.1') }}</strong>
										</span>
										@endif
										@if($course->goal_count > 1)
										<input type="hidden" name="goal_id1" value="{{ $course->goal[1]->id }}">
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="card">
							<div class="card-body">
								<div class="form-group row mb-0">
									<div class="col-md-4 offset-4">
										<button type="submit" name="revision" class="btn btn-danger">{{ __($btnText) }}</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
{{-- 	</div> --}}
			</form>
		</div>
@endsection
