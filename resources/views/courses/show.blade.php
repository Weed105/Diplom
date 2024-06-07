@extends('layouts.main')

@section('content')
    <section class="course_details_area ">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 course_details_left">
                    <div class="content_wrapper">
                        <h4 class="title_top" style="font-size: 38px;">Описание</h4>
                        <div class="content" style="font-size: 18px; color: black">
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
                                        <p style="font-size: 18px">Учреждение &nbsp;&nbsp;&nbsp;</p>
                                        <span style="font-size: 17px" class="color">{{ $course->institution->name }}</span>
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

                <div class="col-lg-8 course_details_left">
                    <div class="content_wrapper">
                        <h4 class="title_top" style="font-size: 38px;">Содержание</h4>
                        <div class="content" style="font-size: 18px; color: black">
                            {{ $course->material }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
