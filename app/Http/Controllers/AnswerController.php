<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function create(Request $request, Course $course)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('uploads'); // сохранить файл в папку uploads

            // Сохранить информацию о файле в базу данных
            $fileModel = new FileModel();
            $fileModel->path = $path;
            $fileModel->save();


            if ($request->input('photo', false)) {
                $course->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }

            return redirect()->route('admin.courses.index');
        }

        return 'File not uploaded.';

        // if (auth()->guest()) {
        //     $request->validate([
        //         'name' => 'required|string|max:255',
        //         'email' => 'required|string|email|max:255|unique:users',
        //         'password' => 'required|string|min:8|confirmed',
        //     ]);

        //     $user = User::create([
        //         'name' => $request->input('name'),
        //         'email' => $request->input('email'),
        //         'password' => Hash::make($request->input('password')),
        //     ]);

        //     auth()->login($user);
        // }

        // $course->enrollments()->create(['user_id' => auth()->user()->id]);

        // return redirect()->route('enroll.myCourses');
    }
}
