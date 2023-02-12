<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="users-table">
            <thead>
            <tr>
                <th>{{__('grades.id')}}</th>
                <th>{{__('grades.name')}}</th>
                <th>{{__('grades.grade')}}</th>
                <th>{{__('grades.weight')}}</th>
                <th>{{__('grades.author')}}</th>
                <th>{{__('grades.student')}}</th>
                <th>{{__('grades.subject')}}</th>
                <th>{{__('grades.created')}}</th>
                <th>{{__('grades.updated')}}</th>
                <th colspan="3">{{__('grades.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($grades as $grade)
                <tr>
                    @include('flash::message')
                    <td>{{ $grade->id }}.</td>
                    <td>{{ $grade->name }}</td>
                    <td>{{ $grade->grade }}</td>
                    <td>{{ $grade->weight }}</td>
                    <td>{{ $grade->author->fullName }}</td>
                    <td>{{ $grade->student->fullName }}</td>
                    <td>{{ $grade->subject->name }}</td>
                    <td>{{ $grade->created_at }}</td>
                    <td>{{ $grade->updated_at }}</td>
                    <td>
                        @can('grades_destroy')
                            {!! Form::open(['route' => ['grades.destroy', $grade->id], 'method' => 'delete']) !!}
                        @endcan
                        <div class='btn-group'>
                            @can('grades_show')
                                <a href="{{ route('grades.show', [$grade->id]) }}"
                                   class='btn btn-default btn-xs'>
                                    <i class="far fa-eye"></i>
                                </a>
                            @endcan
                            @can('grades_edit')
                                <a href="{{ route('grades.edit', [$grade->id]) }}"
                                   class='btn btn-default btn-xs'>
                                    <i class="far fa-edit"></i>
                                </a>
                            @endcan
                            @can('grades_destroy')
                                {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            @endcan
                        </div>
                        @can('grades_destroy')
                            {!! Form::close() !!}
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $grades])
        </div>
    </div>
</div>
