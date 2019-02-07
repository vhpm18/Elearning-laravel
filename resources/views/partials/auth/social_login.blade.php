<div class="col-md-4 mt-5">
	<div class="card">
		<div class="card-header">{{ __("Socialite") }}</div>
		<div class="card-body">
			<div class="kpx_login">
				<div class="row kpx_row-sm-offset-3 kpx_socialButtons">

						<a
							href="{{ route('social_auth', ['driver' => 'github']) }}"
							class="btn btn-lg btn-block kpx_btn-github"
							data-toggle="tooltip"
							data-placement="top"
							title="Github">
							<i class="fa fa-github fa-2x"></i>
							<span class="hidden-xs"></span>
						</a>

						<a
							href="{{ route('social_auth', ['driver' => 'facebook']) }}"
							class="btn btn-lg btn-block kpx_btn-facebook"
							data-toggle="tooltip"
							data-placement="top"
							title="Facebook">
							<i class="fa fa-facebook fa-2x"></i>
							<span class="hidden-xs"></span>
						</a>

				</div>
			</div>
	</div>
</div>
</div>

