<?php

namespace App\Http\Controllers;

use App\Entities\Course;
use App\Entities\Student;
use App\Entities\User;
use App\Mail\MessageToStudent;
use Yajra\DataTables\DataTables;

class TeacherController extends Controller
{

    public function students()
    {
        $actions  = 'students.datatables.actions';
        $students = Student::with('user', 'courses.reviews')
            ->whereHas('courses', function ($q) {
                $q->where('teacher_id', auth()->user()->teacher->id)
                    ->select('courses.id', 'courses.teacher_id', 'courses.name')
                    ->withTrashed();
            })->get();
        return DataTables::of($students)
            ->addColumn('actions', $actions)
            ->rawColumns(['actions', 'courses_formatted'])
            ->make(true);
    }

    public function courses()
    {
        if (!isset(auth()->user()->teacher->id)) {
            return back()->with('message', ['success', __("No tiene cursos asociados ya que no es profesor...")]);
        }
        $courses = Course::withCount('students')
            ->with('category', 'reviews')
            ->whereTeacherId(auth()->user()->teacher->id)
            ->paginate(12);

        return view('teachers.courses', compact('courses'));
    }

    public function sendMessageToStudent()
    {
        $info = \request('info');
        $data = [];
        parse_str($info, $data);
        $user = User::findOrFail($data['user_id']);
        //return new MessageToStudent(auth()->user()->name, $data['message']);
        try {
            \Mail::to($user)->send(new MessageToStudent(auth()->user()->name, $data['message']));
            $success = true;
        } catch (Exception $e) {
            $success = false;
        }
        return response()->json(['res' => $success]);
    }
}
