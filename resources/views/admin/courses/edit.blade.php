@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.course.title_singular') }}
        </div>

        <div class="card-body">
            <form action="{{ route('admin.courses.update', [$course->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name">{{ trans('cruds.course.fields.name') }}*</label>
                    <input type="text" id="name" name="name" class="form-control"
                        value="{{ old('name', isset($course) ? $course->name : '') }}" required>
                    @if ($errors->has('name'))
                        <em class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.course.fields.name_helper') }}
                    </p>
                </div>
                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    <label for="description">{{ trans('cruds.course.fields.description') }}</label>
                    <textarea id="description" name="description" class="form-control ">{{ old('description', isset($course) ? $course->description : '') }}</textarea>
                    @if ($errors->has('description'))
                        <em class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.course.fields.description_helper') }}
                    </p>
                </div>
                <div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }}">
                    <label for="photo">{{ trans('cruds.course.fields.photo') }}</label>
                    <div class="needsclick dropzone" id="photo-dropzone">

                    </div>
                    @if ($errors->has('photo'))
                        <em class="invalid-feedback">
                            {{ $errors->first('photo') }}
                        </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.course.fields.photo_helper') }}
                    </p>
                </div>

                @if (auth()->user()->isInstitution())
                    <input type="hidden" name="institution_id" value="{{ auth()->user()->institution_id }}">
                @else
                    <div class="form-group {{ $errors->has('institution_id') ? 'has-error' : '' }}">
                        <label for="institution">{{ trans('cruds.course.fields.institution') }}*</label>
                        <select name="institution_id" id="institution" class="form-control select2" required>
                            @foreach ($institutions as $id => $institution)
                                <option value="{{ $id }}"
                                    {{ (isset($course) && $course->institution ? $course->institution->id : old('institution_id')) == $id ? 'selected' : '' }}>
                                    {{ $institution }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('institution_id'))
                            <em class="invalid-feedback">
                                {{ $errors->first('institution_id') }}
                            </em>
                        @endif
                    </div>
                @endif


                <div class="form-group {{ $errors->has('teacher') ? 'has-error' : '' }}">
                    <label for="teacher">Преподаватель*</label>
                    <select name="teacher" id="teacher" class="form-control select2" required>
                        @foreach ($teachers as $id => $teacher)
                            <option value="{{ $id }}"
                                {{ (isset($course) && $course->teacher_id ? $course->teacher_id->id : old('teacher')) == $id ? 'selected' : '' }}>
                                {{ $teacher }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('teacher'))
                        <em class="invalid-feedback">
                            {{ $errors->first('teacher') }}
                        </em>
                    @endif
                </div>


                <div class="form-group {{ $errors->has('material') ? 'has-error' : '' }}">
                    <label for="material">Материал</label>
                    <textarea id="material" name="material" class="form-control ">{{ old('material', isset($course) ? $course->material : '') }}</textarea>
                    @if ($errors->has('material'))
                        <em class="invalid-feedback">
                            {{ $errors->first('material') }}
                        </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.course.fields.materials_helper') }}
                    </p>
                </div>

                <div class="form-group {{ $errors->has('homework') ? 'has-error' : '' }}">
                    <label for="homework">Домашнее задание</label>
                    <textarea id="homework" name="homework" class="form-control ">{{ old('homework', isset($course) ? $course->homework : '') }}</textarea>
                    @if ($errors->has('homework'))
                        <em class="invalid-feedback">
                            {{ $errors->first('homework') }}
                        </em>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="status">Статус</label>
                    <select name="status" id="status" class="form-control select2" required>
                        <option value="Не запущен"
                            {{ (isset($course) && $course->status ? $course->status : old('status')) == 'Не запущен' ? 'selected' : '' }}>
                            Не запущен</option>
                        <option value="Запущен"
                            {{ (isset($course) && $course->status ? $course->status : old('status')) == 'Запущен' ? 'selected' : '' }}>
                            Запущен</option>
                        <option value="Завершен"
                            {{ (isset($course) && $course->status ? $course->status : old('status')) == 'Завершен' ? 'selected' : '' }}>
                            Завершен</option>
                    </select>
                    @if ($errors->has('status'))
                        <em class="invalid-feedback">
                            {{ $errors->first('status') }}
                        </em>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('disciplines') ? 'has-error' : '' }}">
                    <label for="disciplines">{{ trans('cruds.course.fields.disciplines') }}
                        <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                    <select name="disciplines[]" id="disciplines" class="form-control select2" multiple="multiple">
                        @foreach ($disciplines as $id => $disciplines)
                            <option value="{{ $id }}"
                                {{ in_array($id, old('disciplines', [])) || (isset($course) && $course->disciplines->contains($id)) ? 'selected' : '' }}>
                                {{ $disciplines }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('disciplines'))
                        <em class="invalid-feedback">
                            {{ $errors->first('disciplines') }}
                        </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.course.fields.disciplines_helper') }}
                    </p>
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
            init: function() {
                @if (isset($course) && $course->photo)
                    var file = {!! json_encode($course->photo) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, '{{ $course->photo->getUrl('thumb') }}')
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
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
