<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="users-table">
            <thead>
            <tr>
                <th>{{__('children.avatar')}}</th>
                <th>{{__('children.id')}}</th>
                <th>{{__('children.fName')}}</th>
                <th>{{__('children.lName')}}</th>
                <th>{{__('children.childGroups')}}</th>
                <th>{{__('children.childSubjects')}}</th>
                <th>{{__('children.childTeachers')}}</th>
                <th colspan="3">{{__('children.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($children as $child)
                <tr>
                    @include('flash::message')
                    <td><img src="/avatars/{{ $child->avatar }}" class="user-image img-circle elevation-2"
                             style="width: 50px" alt="User profile picture"></td>
                    <td>{{ $child->id }}.</td>
                    <td>{{ $child->fname }}</td>
                    <td>{{ $child->lname }}</td>
                    <td>{{ $child->groups()->count() }}</td>
                    <td>{{ $child->subjects()->count() }}</td>
                    <td>{{ $child->teachers()->count() }}</td>
                    <td>
                        <div class='btn-group'>
                            @can('children_access')
                                <a href="{{ route('children.show', [$child->id]) }}"
                                   class='btn btn-default btn-xs'>
                                    <i class="far fa-eye"></i>
                                </a>
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
            @include('adminlte-templates::common.paginate', ['records' => $children])
        </div>
    </div>
</div>
