@section('title')
    {{'Add grade'}}
@endsection
@extends('layouts.app')

@section('content')
    @can('grades_create')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        <i class="fas fa-user"></i>
                        {{__('grades.addGrade')}}
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="card">

            {!! Form::open(['route' => 'grades.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('grades.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit(__('grades.add'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('grades.index') }}" class="btn btn-default"> {{__('grades.cancel')}} </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
    @endcan
@endsection
