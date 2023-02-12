@section('title')
    {{$grade->name}}
@endsection
@extends('layouts.app')

@section('content')
    @can('grades_show')
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
                            {{__('grades.back')}}
                        </a>
                        @can('print_grades')
                            <a class="btn btn-primary float-right mr-1" id="print-button">
                                {{__('grades.print')}}
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card card-primary" id="print-data">
                    <div class="card-header">
                        <h3 class="card-title">{{__('grades.detail')}} {{$grade->name}}</h3>
                    </div>
                    <div class="card-body" id="print-data">
                        @include('flash::message')

                        <strong>{{__('grades.id')}}</strong>
                        <p class="text-muted">{{$grade->id}}</p>

                        <strong>{{__('grades.name')}}</strong>
                        <p class="text-muted">{{$grade->name}}</p>

                        <strong>{{__('grades.weight')}}</strong>
                        <p class="text-muted">{{$grade->weight}}</p>

                        <strong>{{__('grades.grade')}}</strong>
                        <p class="text-muted">{{$grade->grade}}</p>

                        <strong>{{__('grades.author')}}</strong>
                        <p class="text-muted">{{$grade->author->fullName}}</p>

                        <strong>{{__('grades.student')}}</strong>
                        <p class="text-muted">{{$grade->student->fullName}}</p>

                        <strong>{{__('grades.subject')}}</strong>
                        <p class="text-muted">{{$grade->subject->name}}</p>

                        <strong>{{__('grades.created')}}</strong>
                        <p class="text-muted">{{$grade->created_at}}</p>

                        <strong>{{__('grades.updated')}}</strong>
                        <p class="text-muted">{{$grade->updated_at}}</p>
                    </div>
                </div>
            </div>
        </section>
    @endcan
    @can('print_grades')
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
