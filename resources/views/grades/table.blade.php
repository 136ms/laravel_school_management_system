<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="users-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Grade</th>
                <th>Weight</th>
                <th>Author</th>
                <th>Student</th>
                <th>Subject</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th colspan="3">Actions</th>
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
                        {!! Form::open(['route' => ['grades.destroy', $grade->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('grades.show', [$grade->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('grades.edit', [$grade->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
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
