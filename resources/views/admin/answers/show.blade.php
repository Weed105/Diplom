@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} Ответа
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
                                {{ $answer->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Курс
                            </th>
                            <td>
                                {{ $answer->course->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Студент
                            </th>
                            <td>
                                {{ $answer->user->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Ответ
                            </th>
                            <td>
                                {{ $answer->answer ?? '' }}

                            </td>
                        </tr>
                        <tr>
                            <th>
                                Оценка
                            </th>
                            <td>
                                {{ $answer->score ?? '' }}
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
