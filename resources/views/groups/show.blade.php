@section('title')
    {{$group->name}}
@endsection
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        <i class="fas fa-users"></i>
                        {{$group->name}}
                    </h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('groups.index') }}">
                        Back
                    </a>
                </div>
            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">About {{$group->name}}</h3>
                </div>
                <div class="card-body">
                    <strong>Group ID</strong>
                    <p class="text-muted">{{$group->id}}</p>
                    <strong>Group name</strong>
                    <p class="text-muted">{{$group->name}}</p>
                    <strong>Group users</strong>
                    <p class="text-muted">{{$users}}</p>
                    <strong>Group subjects</strong>
                    <p class="text-muted">{{$subjects}}</p>
                    <strong>Created at</strong>
                    <p class="text-muted">{{$group->created_at}}</p>
                    <strong>Updated at</strong>
                    <p class="text-muted">{{$group->updated_at}}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
