@section('title')
    {{'Child list'}}
@endsection
@extends('layouts.app')

@section('content')
    @can('children_access')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-user"></i> Child list</h1>
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
