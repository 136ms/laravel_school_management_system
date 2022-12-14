@section('title')
    {{$subject->name}}
@endsection
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        <i class="fas fa-book"></i>
                        {{$subject->name}}
                    </h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('subjects.index') }}">
                        Back
                    </a>
                </div>
            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">About {{$subject->name}}</h3>
                </div>
                <div class="card-body">
                    <strong>Subject ID</strong>
                    <p class="text-muted">{{$subject->id}}</p>
                    <strong>Subject name</strong>
                    <p class="text-muted">{{$subject->name}}</p>
                    <strong>Subject group IDs</strong>
                    @foreach($subject->groups as $group)
                        <p class="text-muted">[{{ $group->id }}.] {{ $group->name }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
