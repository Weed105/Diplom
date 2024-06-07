@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} ответа
        </div>

        <div class="card-body">
            <form action="{{ route('admin.answers.update', [$answer->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group {{ $errors->has('course_id') ? 'has-error' : '' }}">
                    <label for="course">Курс*</label>

                    <input disabled name="course_id" class="form-control"
                        value="{{ isset($answer) && $answer->course ? $answer->course->name : '' }}">

                    @if ($errors->has('course_id'))
                        <em class="invalid-feedback">
                            {{ $errors->first('course_id') }}
                        </em>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('student') ? 'has-error' : '' }}">
                    <label for="student">Студент*</label>

                    <input type="text" disabled name="student_id" class="form-control"
                        value="{{ isset($answer) && $answer->user ? $answer->user->name : '' }}">


                    @if ($errors->has('student'))
                        <em class="invalid-feedback">
                            {{ $errors->first('student') }}
                        </em>
                    @endif
                </div>


                <div class="form-group {{ $errors->has('answer') ? 'has-error' : '' }}">
                    <label for="answer">Ответ</label>
                    <input type="text" disabled id="answer" name="answer" class="form-control"
                        value="{{ old('answer', isset($answer) ? $answer->answer : '') }}" required>

                    @if ($errors->has('answer'))
                        <em class="invalid-feedback">
                            {{ $errors->first('answer') }}
                        </em>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('score') ? 'has-error' : '' }}">
                    <label for="score">Оценка</label>


                    <input type="number" id="score" name="score" class="form-control"
                        value="{{ old('score', isset($answer) ? $answer->score : '') }}" required>

                    @if ($errors->has('score'))
                        <em class="invalid-feedback">
                            {{ $errors->first('score') }}
                        </em>
                    @endif
                </div>
                <div>
                    <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                </div>
            </form>


        </div>
    </div>
@endsection

@section('scripts')
    <script>
        Dropzone.options.photoDropzone = {
            url: '{{ route('admin.courses.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="photo"]').remove()
                $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="photo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },

            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
@stop
