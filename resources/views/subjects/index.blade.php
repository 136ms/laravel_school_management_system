@section('title')
    {{'Subject list'}}
@endsection
@extends('layouts.app')

@section('content')
    @can('subjects_access')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-book"></i> Subject list</h1>
                    </div>
                    @can('subjects_create')
                        <div class="col-sm-6">
                            <a class="btn btn-primary float-right"
                               href="{{ route('subjects.create') }}">
                                Add Subject
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
                @include('subjects.table')
            </div>
        </div>
    @endcan
@endsection
