@section('title')
    {{"Grade list"}}
@endsection
@extends('layouts.app')

@section('content')
    @can('grades_access')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-graduation-cap"></i> {{__('grades.gradeList')}}</h1>
                    </div>
                    @can('grades_create')
                        <div class="col-sm-6">
                            <a class="btn btn-primary float-right"
                               href="{{ route('grades.create') }}">
                                {{__('grades.addGrade')}}
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
                @can('grades_teacher_table')
                    @include('grades.table')
                @endcan
                @cannot('Admin|Parent|Teacher')
                    @can('grades_student_table')
                        @include('grades.userTable')
                    @endcan
                @endcannot
            </div>
        </div>
    @endcan
@endsection
