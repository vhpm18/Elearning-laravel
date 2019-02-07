<div>
	<ul class="list-inline">
		<li class="list-inline-item">
			<i class="fa fa-star {{ $course->rating >= 1 ? 'yellow' : '' }}"></i>
			<i class="fa fa-star {{ $course->rating >= 2 ? 'yellow' : '' }}"></i>
			<i class="fa fa-star {{ $course->rating >= 3 ? 'yellow' : '' }}"></i>
			<i class="fa fa-star {{ $course->rating >= 4 ? 'yellow' : '' }}"></i>
			<i class="fa fa-star {{ $course->rating >= 5 ? 'yellow' : '' }}"></i>
		</li>
	</ul>
</div>
