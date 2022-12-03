<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="classes-table">
            <thead>
            <tr>
                <th>Class ID</th>
                <th>Class name</th>
                <th colspan="3">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($classes as $class)
                <tr>
                    <td>{{ $class->id }}.</td>
                    <td>{{ $class->class_name }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['classes.destroy', $class->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('classes.show', [$class->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('classes.edit', [$class->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $classes])
        </div>
    </div>
</div>
