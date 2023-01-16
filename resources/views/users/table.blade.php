<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="users-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Birth date</th>
                <th>Address</th>
                <th>E-mail</th>
                <th>Gender</th>
                <th>Phone number</th>
                <th>Role</th>
                <th>Groups</th>
                <th>Subjects</th>
                <th>Parents</th>
                <th>Teachers</th>
                <th colspan="3">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    @include('flash::message')
                    <td>{{ $user->id }}.</td>
                    <td>{{ $user->fname }}</td>
                    <td>{{ $user->lname }}</td>
                    <td>{{ date_format($user->birthdate, "d.m.Y") }}</td>
                    <td>{{ mb_strimwidth($user->address, 0, 10, "...") }}</td>
                    <td>{{ mb_strimwidth($user->email, 0, 6, "...") }}</td>
                    <td>{{ mb_strimwidth($user->gender, 0, 10, "...")}}</td>
                    <td>{{ $user->phonenum }}</td>
                    <td>
                    @foreach($user->roles as $role)
                        {{ $role['name'] }}
                    @endforeach
                    </td>
                    <td>{{ $user->groups()->count() }}</td>
                    <td>{{ $user->subjects()->count() }}</td>
                    <td>{{ $user->parents()->count() }}</td>
                    <td>{{ $user->teachers()->count() }}</td>
                    <td>
                        {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('users.show', [$user->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('users.edit', [$user->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $users])
        </div>
    </div>
</div>
