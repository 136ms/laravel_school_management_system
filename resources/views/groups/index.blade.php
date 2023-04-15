@section('title')
    {{__('titles.list')}}
@endsection
@extends('layouts.app')

@section('content')
    @can('groups_access')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-users"></i> {{__('groups.groupList')}}</h1>
                    </div>
                    @can('groups_create')
                        <div class="col-sm-6">
                            <a class="btn btn-primary float-right"
                               href="{{ route('groups.create') }}">
                                {{__('groups.addGroup')}}
                            </a>
                        </div>
                    @endcan
                    <div class="col-sm-12 mt-4">
                        <form method="GET" action="{{ route('search.groups') }}">
                            <div class="form-group">
                                <div class="input-group input-group-lg">
                                    <input type="search" name="query" class="form-control form-control-lg"
                                           placeholder="{{__('search.searchGroups')}}"
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
                @include('groups.table')
            </div>
        </div>
    @endcan
@endsection
