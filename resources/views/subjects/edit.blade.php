@section('title')
    {{'Edit subject'}}
@endsection
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        <i class="fas fa-book"></i>
                        Edit Subject
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')
        @can('subject_users_update')
            <a href="{{ route('subjects.users.show', $subject->id) }}" class="btn btn-primary"> Manage users </a>
        @endcan
        @can('subject_groups_update')
            <a href="{{ route('subjects.groups.show', $subject->id) }}" class="btn btn-primary"> Manage groups </a>
        @endcan

        <div class="card">

            {!! Form::model($subject, ['route' => ['subjects.update', $subject->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('subjects.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('subjects.index') }}" class="btn btn-default"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
