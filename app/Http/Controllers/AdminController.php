<?php

namespace App\Http\Controllers;

use App\Entities\Course;
use App\Entities\Teacher;
use App\Entities\User;
use App\Mail\CourseApproved;
use App\Mail\CourseRejected;
use App\Mail\MessageToStudent;
use App\VueTables\EloquentVueTables;

class AdminController extends Controller
{
    public function courses()
    {
        return view('admin.courses');
    }
    public function coursesJson()
    {
        if (request()->ajax()) {
            $vueTable = new EloquentVueTables;
            $data     = $vueTable->get(new Course, ['id', 'name', 'status'], ['reviews']);
            return response()->json($data);
        }
        return abort(401, __("No puedes acceder a está url"));
    }

    public function updateCourseStatus()
    {
        if (request()->ajax()) {
            $course = Course::findOrfail(\request('courseId'));
            if (
                (int) $course->status !== Course::PUBLISHED &&
                !$course->previous_approved &&
                \request('status') === Course::PUBLISHED
            ) {
                $course->previous_approved = true;
                // return new CourseApproved($course);
                \Mail::to($course->teacher->user)->send(new CourseApproved($course));
            }
            if (
                (int) $course->status !== Course::REJECTED &&
                !$course->previous_rejected &&
                \request('status') === Course::REJECTED
            ) {
                $course->previous_rejected = true;
                //return new CourseRejected($course);
                \Mail::to($course->teacher->user)->send(new CourseRejected($course));
            }
            $course->status = \request('status');
            $course->save();
            return reponse()->json(['msj' => 'ok']);
            return abort(401, __("No puedes acceder a está url"));
        }
    }

    public function students()
    {
        return view('admin.students');
    }

    public function studentsJson()
    {
        if (request()->ajax()) {
            $vueTable = new EloquentVueTables;
            $data     = $vueTable->get(new User, ['*'], ['student']);
            return response()->json($data);
        }
        return abort(401, __("No puedes acceder a está url"));
    }

    public function teachers()
    {
        return view('admin.teachers');
    }

    public function teachersJson()
    {
        if (request()->ajax()) {
            $vueTable = new EloquentVueTables;
            $data     = $vueTable->get(new Teacher, ['*'], ['user']);
            return response()->json($data);
        }
        return abort(401, __("No puedes acceder a está url"));
    }

    public function sendMessageUser()
    {
        if (request()->ajax()) {
            if ((int) \request('typeUser') === 3) {
                $user = User::with('student')->findOrfail(\request('user_id'));
            } else if ((int) \request('typeUser') === 2) {
                $user = User::with('teacher')->findOrfail(\request('user_id'));
            }
            try {
                \Mail::to($user)->send(new MessageToStudent(auth()->user()->name, \request('message')));
                $success = true;
            } catch (Exception $e) {
                $success = false;
            }
            return response()->json(['res' => $success]);
        }
        return abort(401, __("No puedes acceder a está url"));
    }

}
