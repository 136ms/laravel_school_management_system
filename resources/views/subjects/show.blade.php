@section('title')
    {{$subject->subject_name}}
@endsection
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        <i class="fas fa-book"></i>
                        {{$subject->subject_name}}
                    </h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('users.index') }}">
                        Back
                    </a>
                </div>
            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">About {{$subject->subject_name}}</h3>
                </div>
                <div class="card-body">
                    <strong>Subject name</strong>
                    <p class="text-muted">{{$subject->subject_name}}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
