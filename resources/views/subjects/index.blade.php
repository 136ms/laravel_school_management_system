@section('title')
    {{__('titles.list')}}
@endsection
@extends('layouts.app')

@section('content')
    @can('subjects_access')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-book"></i> {{__('subjects.subjectList')}}</h1>
                    </div>
                    @can('subjects_create')
                        <div class="col-sm-6">
                            <a class="btn btn-primary float-right"
                               href="{{ route('subjects.create') }}">
                                {{__('subjects.addSubject')}}
                            </a>
                        </div>
                    @endcan
                    <div class="col-sm-12 mt-4">
                        <form method="GET" action="{{ route('search.subjects') }}">
                            <div class="form-group">
                                <div class="input-group input-group-lg">
                                    <input type="search" name="query" class="form-control form-control-lg"
                                           placeholder="{{__('search.searchSubjects')}}"
                                           value="{{ request('query') }}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-lg btn-default">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
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
