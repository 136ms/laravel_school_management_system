@section('title')
    {{$grade->name}}
@endsection
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        <i class="fas fa-user"></i>
                        {{$grade->name}}
                    </h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('grades.index') }}">
                        Back
                    </a>
                    <a class="btn btn-primary float-right mr-1" id="print-button">
                        Print
                    </a>
                </div>
            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">About {{$grade->name}}</h3>
                </div>
                <div class="card-body" id="print-data">
                    @include('flash::message')

                    <strong>ID</strong>
                    <p class="text-muted">{{$grade->id}}</p>

                    <strong>Name</strong>
                    <p class="text-muted">{{$grade->name}}</p>

                    <strong>Weight</strong>
                    <p class="text-muted">{{$grade->weight}}</p>

                    <strong>Grade</strong>
                    <p class="text-muted">{{$grade->grade}}</p>

                    <strong>Author</strong>
                    <p class="text-muted">{{$grade->author->fullName}}</p>

                    <strong>Student</strong>
                    <p class="text-muted">{{$grade->student->fullName}}</p>

                    <strong>Subject</strong>
                    <p class="text-muted">{{$grade->subject->name}}</p>

                    <strong>Created at</strong>
                    <p class="text-muted">{{$grade->created_at}}</p>

                    <strong>Updated at</strong>
                    <p class="text-muted">{{$grade->updated_at}}</p>
                </div>
            </div>
        </div>
    </section>
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
@endsection
