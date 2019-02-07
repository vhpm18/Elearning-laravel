<?php

namespace App\Http\Controllers;

use App\Entities\Course;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::withCount('students')
            ->with('category', 'teacher', 'reviews')
            ->where('status', Course::PUBLISHED)
            ->latest()
            ->paginate(12);
        //dd($courses);
        return view('home', compact('courses'));
    }
}
