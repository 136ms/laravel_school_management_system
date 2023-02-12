<div class="card-body p-0">
    <div class="table-responsive">
        @include('flash::message')
        <table class="table" id="groups-table">
            <thead>
            <tr>
                <th>{{__('groups.id')}}</th>
                <th>{{__('groups.groupName')}}</th>
                <th>{{__('groups.groupUsers')}}</th>
                <th>{{__('groups.groupSubjects')}}</th>
                <th colspan="3">{{__('groups.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($groups as $group)
                <tr>
                    <td>{{ $group->id }}.</td>
                    <td>{{ $group->name }}</td>
                    <td>{{ $group->users()->count() }}</td>
                    <td>{{ $group->subjects()->count() }}</td>
                    <td style="width: 120px">
                        @can('groups_destroy')
                            {!! Form::open(['route' => ['groups.destroy', $group->id], 'method' => 'delete']) !!}
                        @endcan
                        <div class='btn-group'>
                            @can('groups_show')
                                <a href="{{ route('groups.show', [$group->id]) }}"
                                   class='btn btn-default btn-xs'>
                                    <i class="far fa-eye"></i>
                                </a>
                            @endcan
                            @can('groups_edit')
                                <a href="{{ route('groups.edit', [$group->id]) }}"
                                   class='btn btn-default btn-xs'>
                                    <i class="far fa-edit"></i>
                                </a>
                            @endcan
                            @can('groups_destroy')
                                {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            @endcan
                        </div>
                        @can('groups_destroy')
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
            @include('adminlte-templates::common.paginate', ['records' => $groups])
        </div>
    </div>
</div>
