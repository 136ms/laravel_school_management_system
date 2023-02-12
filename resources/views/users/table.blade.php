<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="users-table">
            <thead>
            <tr>
                <th>{{__('users.avatar')}}</th>
                <th>{{__('users.iD')}}</th>
                <th>{{__('users.fName')}}</th>
                <th>{{__('users.lName')}}</th>
                <th>{{__('users.bDate')}}</th>
                <th>{{__('users.address')}}</th>
                <th>{{__('users.email')}}</th>
                <th>{{__('users.gender')}}</th>
                <th>{{__('users.phone')}}</th>
                <th>{{__('users.roles')}}</th>
                <th>{{__('users.groups')}}</th>
                <th>{{__('users.subjects')}}</th>
                <th>{{__('users.parents')}}</th>
                <th>{{__('users.teachers')}}</th>
                <th colspan="3">{{__('users.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    @include('flash::message')
                    <td><img src="/avatars/{{ $user->avatar }}" class="user-image img-circle elevation-2"
                             style="width: 50px" alt="User profile picture"></td>
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
                        @can('users_destroy')
                            {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                        @endcan
                        <div class='btn-group'>
                            @can('users_show')
                                <a href="{{ route('users.show', [$user->id]) }}"
                                   class='btn btn-default btn-xs'>
                                    <i class="far fa-eye"></i>
                                </a>
                            @endcan
                            @can('users_edit')
                                <a href="{{ route('users.edit', [$user->id]) }}"
                                   class='btn btn-default btn-xs'>
                                    <i class="far fa-edit"></i>
                                </a>
                            @endcan
                            @can('users_destroy')
                                {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            @endcan
                        </div>
                        @can('users_destroy')
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
            @include('adminlte-templates::common.paginate', ['records' => $users])
        </div>
    </div>
</div>
