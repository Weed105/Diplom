@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Список Ответов
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Answer">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                Курс
                            </th>
                            <th>
                                Студент
                            </th>
                            <th>
                                Ответ
                            </th>
                            <th>
                                Оценка
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($answers as $key => $answer)
                            <tr data-entry-id="{{ $answer->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $answer->course->name ?? '' }}
                                </td>
                                <td>
                                    {{ $answer->user->name ?? '' }}
                                </td>
                                <td>
                                    <a class="btn btn-xs btn-info" href="{{ route('storage', $answer->answer) }}">Открыть
                                        файл</a>
                                </td>
                                <td>
                                    {{ $answer->score ?? '' }}
                                </td>

                                <td>
                                    @can('answer_show')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.answers.show', $answer->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan


                                    @can('answer_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.answers.edit', $answer->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('course_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.courses.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            $('.datatable-Answer:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })
    </script>
@endsection
