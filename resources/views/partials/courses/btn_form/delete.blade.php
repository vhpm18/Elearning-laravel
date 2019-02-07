<form action="{{ route('courses.destroy', ['slug' => $course->slug]) }}" method="POST">
	@csrf
	@method('DELETE')
	<div>
		<button type="submit" value="Submit" class="btn btn-danger text-white" >
			<i class="fa fa-trash"></i> {{ __("Eliminar curso") }}
		</button>
	</div>
</form>
