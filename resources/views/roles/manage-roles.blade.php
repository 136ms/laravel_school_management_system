@section('title')
    {{'Manage roles'}}
@endsection
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        <i class="fas fa-user"></i>
                        {{__('users.userManageRoles')}}
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')
        <div class="card">
            {!! Form::open(['route' => ['users.roles.update',$user->id ], 'method' => 'patch']) !!}
            <div class="card-body">
                <div class="row">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="form-group">
                        <h5>{{$user->fullName}}</h5>
                        {!! Form::label('roles[]', __('users.userManageRoles')) !!}
                        {!! Form::select('roles[]', $roles->pluck('name', 'id'), $user->roles->pluck('id'), ['class' => 'form-control', 'multiple'=> 'multiple']) !!}
                    </div>
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit(__('users.roleSubmit'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-default"> {{__('users.userCancel')}} </a>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection
