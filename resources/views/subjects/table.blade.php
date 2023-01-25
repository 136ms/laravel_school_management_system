<div class="card-body p-0">
    <div class="table-responsive">
        @include('flash::message')
        <table class="table" id="subjects-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Groups</th>
                <th>Users</th>
                <th colspan="3">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($subjects as $subject)
                <tr>
                    <td>{{ $subject->id }}.</td>
                    <td>{{ $subject->name }}</td>
                    <td>{{ $subject->groups()->count() }}</td>
                    <td>{{ $subject->users()->count() }}</td>
                    <td style="width: 120px">
                        @can('subjects_destroy')
                            {!! Form::open(['route' => ['subjects.destroy', $subject->id], 'method' => 'delete']) !!}
                        @endcan
                        <div class='btn-group'>
                            @can('subjects_show')
                                <a href="{{ route('subjects.show', [$subject->id]) }}"
                                   class='btn btn-default btn-xs'>
                                    <i class="far fa-eye"></i>
                                </a>
                            @endcan
                            @can('subjects_edit')
                                <a href="{{ route('subjects.edit', [$subject->id]) }}"
                                   class='btn btn-default btn-xs'>
                                    <i class="far fa-edit"></i>
                                </a>
                            @endcan
                            @can('subjects_destroy')
                                {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            @endcan
                        </div>
                        @can('subjects_destroy')
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
            @include('adminlte-templates::common.paginate', ['records' => $subjects])
        </div>
    </div>
</div>
