<?php

namespace App\Http\Controllers;

use App\Entities\Course;
use App\Entities\Review;
use App\Entities\User;
use App\Http\Requests\CourseRequest;
use App\Mail\NewStudentInCourse;

class CourseController extends Controller
{
    public function show( ? Course $course)
    {
        $course
            ->load([
                'category'     => function ($q) {
                    $q->select('id', 'name');
                },
                'goal'         => function ($q) {
                    $q->select('id', 'course_id', 'goal');
                },
                'requirements' => function ($q) {
                    $q->select('id', 'course_id', 'requirement');
                },
                // 'reviews'      => function ($q) {    Otra forma de hacer la carga de datos
                //     $q->select('course_id', 'user_id', 'rating', 'comment')
                //         ->with('user');

                // },
                'reviews.user',
                'teacher.user',
            ])
            ->get();
        //dd($course);
        $related = $course->relatedCourses();

        return view('courses.detail', compact('course', 'related'));
    }

    public function inscribe( ? Course $course)
    {
        //return new NewStudentInCourse($course, "admin");
        $course->students()->attach(auth()->user()->id);
        return new NewStudentInCourse($course, "admin");
        //\Mail::to($course->teacher->user)->send(new NewStudentInCourse($course, auth()->user()->name));
        return back()->with('message', ['success', __("Inscrito correctamente en el curso...")]);
    }

    public function subscribed()
    {
        $courses = Course::whereHas('students', function ($q) {
            $q->where('user_id', auth()->id());
        })->get();
        return view('courses.subscribed', compact('courses'));
    }

    public function addReview()
    {
        Review::create([
            'user_id'   => auth()->id(),
            'course_id' => request('course_id'),
            'rating'    => request('rating_input'),
            'comment'   => request('message'),
        ]);
        return back()->with('message', ['success', __("Muchas gracias por valorar el curso")]);
    }

    public function create()
    {
        $course  = new Course;
        $btnText = __("Enviar curso para revisión");
        return view('courses.form', compact('course', 'btnText'));
    }

    public function store(CourseRequest $courseRequest)
    {
        //$courseRequest->merge(['picture' => Helper::uploadFile('picture', 'courses')]);
        $courseRequest->merge(['teacher_id' => auth()->user()->teacher->id]);
        $courseRequest->merge(['status' => Course::PENDING]);
        Course::create($courseRequest->except('_token'));
        return back()->with('message', ['success', __("Curso enviado correctamente, recibirá un correo con cualquier información")]);
    }

    public function edit($slug)
    {
        $course = Course::with(['requirements', 'goal'])
            ->withCount(['requirements', 'goal'])
            ->whereSlug($slug)->firstOrfail();

        $btnText = __("Actualizar curso");
        return view('courses.form', compact('course', 'btnText'));
    }

    public function update( ? CourseRequest $courseRequest,  ? Course $course)
    {
        if ($courseRequest->hasFile('picture')) {
            \Storage::delete('courses/' . $course->picture);
        }
        $course->fill($courseRequest->input())->save();
        return back()->with('message', ['success', __("Curso actualizado correctamente, recibirá un correo con cualquier información")]);
    }

    public function destroy( ? Course $course)
    {
        try {
            $course->delete();
            return back()->with('message', ['success', __("Curso eliminado correctamente")]);
        } catch (Exception $e) {
            return back()->with('message', ['danger', __($e->getMessage())]);
        }
    }

}
