@component('mail::message')
# {{ __("Curso Aprobado") }}
{{ __("Tu curso :course ha sido aprobado y ya está publicado en la plataforma",['course' => $course->name]) }}
<img class="img-responsive" src="{{ url('storage/courses/'. $course->picture) }}" alt="{{ $course->name }}">

@component('mail::button',['url' =>url('/')])
{{ __("Ir al curso :course",['course' => $course->name]) }}
@endcomponent
{{ __("Gracias") }},<br/>
{{ config('app.name') }}
@endcomponent
