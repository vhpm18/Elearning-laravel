@cannot('inscribe', $course)
@can('review', $course)
<div class="col-12 pt-0 mt-4 text-center">
	<h2 class="text-muted">{{ __("Escribe una valoración") }}</h2><hr/>
</div>
<div class="row container-fluid">
	<form
		action="{{ route('courses.add_review') }}"
		method="POST"
		class="form-inline"
		id="rating-form">
		@csrf
		<div class="col-4 justify-content-center">
			<div class="form-group">
				<ul id="list_rating" class="list_inline" style="font-size: 40px;">
					<li class="list-inline-item star" data-number="1"><i class="fa fa-star yellow"></i></li>
					<li class="list-inline-item star" data-number="2"><i class="fa fa-star"></i></li>
					<li class="list-inline-item star" data-number="3"><i class="fa fa-star"></i></li>
					<li class="list-inline-item star" data-number="4"><i class="fa fa-star"></i></li>
					<li class="list-inline-item star" data-number="5"><i class="fa fa-star"></i></li>
				</ul>
			</div>
		</div>
		<input type="hidden" name="rating_input" value="1">
		<input type="hidden" name="course_id" value="{{ $course->id }}">
		<div class="col-6 justify-content-center">
			<div class="form-group">
					<textarea
					placeholder="{{ __("Escribe una reseña") }}"
					id="message"
					name="message"
					class="form-control"
					rows="8"
					cols="120">
				</textarea>
			</div>
		</div>
		<div class="col-2">
			<button class="btn btn-warning text-white" type="submit">
				<i class="fa fa-space-shuttle"></i>{{ __("Valorar curso") }}
			</button>
		</div>
</form>
</div>
@endcan
@endcannot
@push('scripts')
<script type="text/javascript">
	jQuery(document).ready(function(){
		const ratingSelector = jQuery('#list_rating');
		ratingSelector.find('li').on('click', function(){
			const number = $(this).data('number');
			$("#rating-form").find('input[name=rating_input]').val(number);
			ratingSelector.find('li i').removeClass('yellow').each(function(index) {
				if((index+1) <=number){
					$(this).addClass('yellow');
				}
			});
		})
	})
</script>
@endpush
