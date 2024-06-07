@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.course.title_singular') }}а
        </div>

        <div class="card-body">
            <div class="mb-2">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.course.fields.id') }}
                            </th>
                            <td>
                                {{ $course->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.course.fields.name') }}
                            </th>
                            <td>
                                {{ $course->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.course.fields.description') }}
                            </th>
                            <td>
                                {!! $course->description !!}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.course.fields.photo') }}
                            </th>
                            <td>
                                @if ($course->photo)
                                    <a href="{{ $course->photo->getUrl() }}" target="_blank">
                                        <img src="{{ $course->photo->getUrl('thumb') }}" width="50px" height="50px">
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.course.fields.institution') }}
                            </th>
                            <td>
                                {{ $course->institution->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Преподаватель
                            </th>
                            <td>
                                {{ $course->teacher_id->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Материал
                            </th>
                            <td>
                                {{ $course->material ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Домашнее задание
                            </th>
                            <td>
                                {{ $course->homework ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Статус
                            </th>
                            <td>
                                {{ $course->status ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.course.fields.disciplines') }}
                            </th>
                            <td>
                                @foreach ($course->disciplines as $id => $disciplines)
                                    <span class="label label-info label-many">{{ $disciplines->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>

            <nav class="mb-3">
                <div class="nav nav-tabs">

                </div>
            </nav>
            <div class="tab-content">

            </div>
        </div>
    </div>
@endsection
