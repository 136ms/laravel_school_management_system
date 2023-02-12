@section('title')
    {{'Edit user'}}
@endsection
@extends('layouts.app')

@section('content')
    @can('users_edit')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        <i class="fas fa-user"></i>
                        {{__('users.userEdit')}}
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')
        @can('roles_update')
            <a href="{{ route('users.roles.update', $user->id) }}" class="btn btn-primary"> {{__('users.userManageRoles')}} </a>
        @endcan
        @can('users_groups_update')
            <a href="{{ route('users.groups.update', $user->id) }}" class="btn btn-primary"> {{__('users.userManageGroups')}} </a>
        @endcan
        @can('users_subjects_update')
            <a href="{{ route('users.subjects.update', $user->id) }}" class="btn btn-primary"> {{__('users.userManageSubjects')}} </a>
        @endcan
        @can('users_parents_update')
            <a href="{{ route('users.parents.update', $user->id) }}" class="btn btn-primary"> {{__('users.userManageParents')}} </a>
        @endcan
        @can('users_parents_update')
            <a href="{{ route('users.teachers.update', $user->id) }}" class="btn btn-primary"> {{__('users.userManageTeachers')}} </a>
        @endcan
        @can('users_picture_update')
            <a href="{{ route('users.avatar.update', $user->id) }}" class="btn btn-primary"> {{__('users.userManageAvatar')}} </a>
        @endcan
        <div class="card">
            {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <img src="/avatars/{{ $user->avatar }}" class="user-image img-circle elevation-2" style="width: 50px"
                     alt="User profile picture">
                <div class="row">
                    @include('users.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit(__('users.userEdit'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('users.index') }}" class="btn btn-default"> {{__('users.userCancel')}} </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
    @endcan
@endsection
