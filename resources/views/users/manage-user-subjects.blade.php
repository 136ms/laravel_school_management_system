@section('title')
    {{'Manage subjects'}}
@endsection
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        <i class="fas fa-user"></i>
                        Manage user subjects
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')
        <div class="card">
            {!! Form::open(['route' => ['users.subjects.update',$user->id ], 'method' => 'patch']) !!}
            <div class="card-body">
                <div class="row">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="form-group">
                        <h5>{{$user->fname}} {{$user->lname}}</h5>
                        {!! Form::label('subjects[]', 'Update subjects:') !!}
                        {!! Form::select('subjects[]', $subjects->pluck('name', 'id'), $user->subjects->pluck('id'), ['class' => 'form-control', 'multiple'=> 'multiple']) !!}
                    </div>
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('users.edit', $user) }}" class="btn btn-default"> Cancel </a>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection
