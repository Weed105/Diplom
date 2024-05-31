<?php

namespace App\Http\Controllers;

use App\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('status', 'Не запущен')->searchResults()
            ->paginate(6);

        $breadcrumb = "Курсы";

        return view('courses.index', compact(['courses', 'breadcrumb']));
    }

    public function show(Course $course)
    {
        $course->load('institution');
        $breadcrumb = $course->name;
        $userEnrollments = [];
        if (auth()->user()) {
            $userEnrollments = auth()->user()
                ->enrollments()
                ->with('course.institution')
                ->orderBy('id', 'desc')
                ->paginate(6);
        }


        return view('courses.show', compact(['course', 'breadcrumb', 'userEnrollments']));
    }
}
