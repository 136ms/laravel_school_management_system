@section('title')
    {{'Group list'}}
@endsection
@extends('layouts.app')

@section('content')
    @can('groups_access')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-users"></i> Group list</h1>
                    </div>
                    @can('groups_create')
                        <div class="col-sm-6">
                            <a class="btn btn-primary float-right"
                               href="{{ route('groups.create') }}">
                                Add Group
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
                @include('groups.table')
            </div>
        </div>
    @endcan
@endsection
