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
                    <a class="btn btn-primary float-right mr-1" id="print-button">
                        Print
                    </a>
                </div>
            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">About {{$subject->name}}</h3>
                </div>
                <div class="card-body">
                    @include('flash::message')
                    <strong>Subject ID</strong>
                    <p class="text-muted">{{$subject->id}}</p>
                    <strong>Subject name</strong>
                    <p class="text-muted">{{$subject->name}}</p>

                    <strong>Subject groups</strong>
                    <p class="text-muted">{{$groups}}</p>

                    <strong>Subject users</strong>
                    <p class="text-muted">{{$users}}</p>
                </div>
            </div>
        </div>
    </section>
    @can('print_subjects')
        <script>
            document.getElementById("print-button").addEventListener("click", function () {
                var dataToPrint = document.getElementById("print-data");
                window.document.write(dataToPrint.innerHTML);
                window.print();
                setTimeout(function () {
                    window.history.back();
                });
            });
        </script>
    @endcan
@endsection
