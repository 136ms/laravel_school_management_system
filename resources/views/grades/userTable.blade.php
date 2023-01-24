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
                <th>Subject</th>
                <th colspan="3">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($userGrades as $grade)
                <tr>
                    @include('flash::message')
                    <td>{{ $grade->id }}.</td>
                    <td>{{ $grade->name }}</td>
                    <td>{{ $grade->grade }}</td>
                    <td>{{ $grade->weight }}</td>
                    <td>{{ $grade->author->fullName }}</td>
                    <td>{{ $grade->subject->name }}</td>
                    <td>
                        <div class='btn-group'>
                            <a href="{{ route('grades.show', [$grade->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                        </div>
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
