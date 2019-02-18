<div class="col-2">
	@auth
		@can('optForCourse', $course)
			@can('subscribe', \App\Entities\Course::class)
				<a
					class="btn btn-block btn-bottom btn-subscribe"
					href="{{ route('subscriptions.plans') }}"
				>
					<i class="fa fa-bolt"></i> {{ __("Subscribirme") }}
				</a>
				@else
				@can('inscribe', $course)
					<a
						class="btn btn-block btn-bottom btn-subscribe"
						href="{{ route('courses.inscribe',['slug' => $course->slug]) }}">
						<i class="fa fa-bolt"></i> {{ __("Inscribirme") }}
					</a>
				@else
					<a class="btn btn-block btn-bottom btn-subscribe" href="">
					<i class="fa fa-bolt"></i> {{ __("Inscrito") }}
				</a>
				@endcan
			@endcan

			@else
			<a class="btn btn-block btn-bottom btn-subscribe" href="">
					<i class="fa fa-user"></i> {{ __("Soy autor") }}
			</a>
		@endcan
	@else
		<a class="btn btn-block btn-bottom btn-subscribe" href="{{ route('login') }}">
			<i class="fa fa-user"></i> {{ __("Acceder") }}
		</a>
	@endauth
</div>
