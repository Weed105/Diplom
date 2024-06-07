<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Course;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function create(Request $request, Course $course)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads');

            $answers = Answer::all();
            $found = false;
            foreach ($answers as $value) {
                if ($value->course_id == $course->id && $value->user_id == auth()->user()->id) {
                    $found = true;
                }
            }
            if ($found) {
                Answer::where(['user_id' => auth()->user()->id, 'course_id' => $course->id, 'score' => 0])
                    ->update(['answer' => $path]);
            } else {
                Answer::create([
                    'answer' => $path,
                    'course_id' =>  $course->id,
                    'user_id' => auth()->user()->id,
                    'score' => 0,
                ]);
            }
            return redirect()->route('enroll.myCourses');
        }
    }
}
