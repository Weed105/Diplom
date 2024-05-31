@extends('layouts.main')

@section('content')
    @if ($course->status == 'Запущен')
        <section class="course_details_area section_padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 course_details_left">
                        <div class="content_wrapper">
                            <h4 class="title_top">Описание</h4>
                            <div class="content">
                                {{ $course->description ?? 'No description provided' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 right-contents">
                        <div class="sidebar_top">
                            <ul>
                                @if ($course->institution)
                                    <li>
                                        <a class="justify-content-between d-flex">
                                            <p>Учреждение &nbsp;&nbsp;&nbsp;</p>
                                            <span class="color">{{ $course->institution->name }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('answer.create', $course->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <input type="file" name="file">
                                            <button class="btn_1 d-block" type="submit">Upload</button>

                                        </form>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8 course_details_left">
                        <div class="content_wrapper">
                            <h4 class="title_top">Материал</h4>
                            <div class="content">
                                {{ $course->material ?? 'No material provided' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 course_details_left">
                        <div class="content_wrapper">
                            <h4 class="title_top">Домашнее задание</h4>
                            <div class="content">
                                {{ $course->homework ?? 'No material provided' }}
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>
    @else
        <section class="course_details_area section_padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 course_details_left">
                        <div class="content_wrapper">
                            <h4 class="title_top">Описание</h4>
                            <div class="content">
                                {{ $course->description ?? 'No description provided' }}
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 right-contents">
                        <div class="sidebar_top">
                            <ul>
                                @if ($course->institution)
                                    <li>
                                        <a class="justify-content-between d-flex">
                                            <p>Учреждение &nbsp;&nbsp;&nbsp;</p>
                                            <span class="color">{{ $course->institution->name }}</span>
                                        </a>
                                    </li>
                                @endif
                                {{-- <li>
                            <a class="justify-content-between d-flex">
                                <p>Стоимость курса</p>
                                <span>{{ $course->getPrice() }}</span>
                            </a>
                        </li> --}}

                            </ul>

                            @php
                                $found = false;
                            @endphp
                            @foreach ($userEnrollments as $enrollment)
                                @if ($enrollment->course_id == $course->id)
                                    @php
                                        $found = true;
                                    @endphp
                                @endif
                            @endforeach

                            @if (!$found)
                                <a href="{{ route('enroll.create', $course->id) }}" class="btn_1 d-block">Записаться на
                                    курс</a>
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </section>
    @endif
@endsection
