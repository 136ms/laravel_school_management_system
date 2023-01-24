@section('title')
    {{'Add user'}}
@endsection
@extends('layouts.app')

@section('content')
    @can('users_create')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>
                            <i class="fas fa-user"></i>
                            Add User
                        </h1>
                    </div>
                </div>
            </div>
        </section>

        <div class="content px-3">

            @include('flash::message')

            <div class="card">

                {!! Form::open(['route' => 'users.store']) !!}

                <div class="card-body">

                    <div class="row">
                        @include('users.fields')
                        <div class="form-group col-sm-6">
                            {!! Form::label('roles[]', 'Roles:') !!}
                            {!! Form::select('roles[]', $roles->pluck('name', 'id'), null, ['class' => 'form-control', 'multiple'=> 'multiple']) !!}
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
                    <a href="{{ route('users.index') }}" class="btn btn-default"> Cancel </a>
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    @endcan
@endsection
