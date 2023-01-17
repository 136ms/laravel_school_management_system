@section('title'){{'User list'}}@endsection
@section('title')
    {{"Grade list"}}
@endsection
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-graduation-cap"></i> Grade list</h1>
                </div>
                @can('grades_create')
                    <div class="col-sm-6">
                        <a class="btn btn-primary float-right"
                           href="{{ route('grades.create') }}">
                            Add Grade
                        </a>
                    </div>
                @endcan
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            @include('grades.table')
        </div>
    </div>

@endsection
