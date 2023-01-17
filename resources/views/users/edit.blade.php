@section('title')
    {{'Edit user'}}
@endsection
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        <i class="fas fa-user"></i>
                        Edit User
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')
        @can('roles_update')
            <a href="{{ route('users.roles.update', $user->id) }}" class="btn btn-primary"> Manage roles </a>
        @endcan
        @can('users_groups_update')
            <a href="{{ route('users.groups.update', $user->id) }}" class="btn btn-primary"> Manage groups </a>
        @endcan
        @can('users_subjects_update')
            <a href="{{ route('users.subjects.update', $user->id) }}" class="btn btn-primary"> Manage subjects </a>
        @endcan
        @can('users_parents_update')
            <a href="{{ route('users.parents.update', $user->id) }}" class="btn btn-primary"> Manage parents </a>
        @endcan
        @can('users_parents_update')
            <a href="{{ route('users.teachers.update', $user->id) }}" class="btn btn-primary"> Manage teachers </a>
        @endcan
        @can('users_picture_update')
            <a href="{{ route('users.avatar.update', $user->id) }}" class="btn btn-primary"> Manage avatar </a>
        @endcan
        <div class="card">
            {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <img src="/avatars/{{ $user->avatar }}" class="user-image img-circle elevation-2" style="width: 50px" alt="User profile picture">
                <div class="row">
                    @include('users.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('users.index') }}" class="btn btn-default"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
