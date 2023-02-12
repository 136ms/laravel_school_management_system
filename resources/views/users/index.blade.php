@section('title')
    {{'User list'}}
@endsection
@extends('layouts.app')

@section('content')
    @can('users_access')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-user"></i> {{__('users.userList')}}</h1>
                    </div>
                    @can('users_create')
                        <div class="col-sm-6">
                            <a class="btn btn-primary float-right"
                               href="{{ route('users.create') }}">
                                {{__('users.addUser')}}
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
                @include('users.table')
            </div>
        </div>
    @endcan
@endsection
