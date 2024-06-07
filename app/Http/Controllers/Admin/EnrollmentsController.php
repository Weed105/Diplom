<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Enrollment;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEnrollmentRequest;
use App\Http\Requests\StoreEnrollmentRequest;
use App\Http\Requests\UpdateEnrollmentRequest;
use App\Mail\DemoEmail;
use App\Mail\FeedbackMailer;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use stdClass;
use Symfony\Component\HttpFoundation\Response;

class EnrollmentsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('enrollment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enrollments = Enrollment::all();

        return view('admin.enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        abort_if(Gate::denies('enrollment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courses = Course::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.enrollments.create', compact('users', 'courses'));
    }

    public function store(StoreEnrollmentRequest $request)
    {
        $enrollment = Enrollment::create($request->all());

        return redirect()->route('admin.enrollments.index');
    }

    public function edit(Enrollment $enrollment)
    {
        abort_if(Gate::denies('enrollment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courses = Course::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $enrollment->load('user', 'course');

        return view('admin.enrollments.edit', compact('users', 'courses', 'enrollment'));
    }

    public function update(UpdateEnrollmentRequest $request, Enrollment $enrollment)
    {
        $enrollment->update($request->all());

        if ($enrollment->status == "Принято") {
            $objDemo = new stdClass();
            $objDemo->name = $enrollment->user->name;
            $objDemo->course = $enrollment->course->name;
            $objDemo->email = $enrollment->user->email;
            $objDemo->start_date = 'ReceiverUserName';
            $objDemo->sender = 'Курсы';
            Mail::to("vbazarbaev188@gmail.com")->send(new DemoEmail($objDemo));
        }

        return redirect()->route('admin.enrollments.index');
    }

    public function show(Enrollment $enrollment)
    {
        abort_if(Gate::denies('enrollment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enrollment->load('user', 'course');

        return view('admin.enrollments.show', compact('enrollment'));
    }

    public function destroy(Enrollment $enrollment)
    {
        abort_if(Gate::denies('enrollment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enrollment->delete();

        return back();
    }

    public function massDestroy(MassDestroyEnrollmentRequest $request)
    {
        Enrollment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
