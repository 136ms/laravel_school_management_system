@section('title')
    {{__('titles.list')}}
@endsection
@extends('layouts.app')

@section('content')
    @can('children_access')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-user"></i> {{__('children.childList')}}</h1>
                    </div>
                    <div class="col-sm-12 mt-4">
                        <form method="GET" action="{{ route('search.children') }}">
                            <div class="form-group">
                                <div class="input-group input-group-lg">
                                    <input type="search" name="query" class="form-control form-control-lg"
                                           placeholder="{{__('search.searchChildren')}}"
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
                @include('children.table')
            </div>
        </div>
    @endcan
@endsection
