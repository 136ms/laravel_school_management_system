@section('title')
    {{'Manage users'}}
@endsection
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        <i class="fas fa-user"></i>
                        Manage group users
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')
        <div class="card">
            {!! Form::open(['route' => ['subjects.users.update',$subject->id ], 'method' => 'patch']) !!}
            <div class="card-body">
                <div class="row">
                    @csrf
                    <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                    <div class="form-group">
                        <h5>{{$subject->name}}</h5>
                        {!! Form::label('users[]', 'Update users:') !!}
                        {!! Form::select('users[]', $users->pluck('lname', 'id'), $subject->users->pluck('id'), ['class' => 'form-control', 'multiple'=> 'multiple']) !!}
                    </div>
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-default"> Cancel </a>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection
