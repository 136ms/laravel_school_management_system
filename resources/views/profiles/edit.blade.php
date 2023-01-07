@section('title'){{'Edit profile'}}@endsection
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        <i class="fas fa-user"></i>
                        Edit Profile
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
        <div class="card">
            {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('users.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('profiles.index') }}" class="btn btn-default"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
