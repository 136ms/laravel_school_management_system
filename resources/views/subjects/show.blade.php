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
                        {{__('subjects.back')}}
                    </a>
                    @can('print_subjects')
                        <a class="btn btn-primary float-right mr-1" id="print-button">
                            {{__('subjects.print')}}
                        </a>
                    @endcan
                </div>
            </div>
            <div class="card card-primary" id="print-data">
                <div class="card-header">
                    <h3 class="card-title">{{__('subjects.about')}} {{$subject->name}}</h3>
                </div>
                <div class="card-body">
                    @include('flash::message')
                    <strong>{{__('subjects.subjectId')}}</strong>
                    <p class="text-muted">{{$subject->id}}</p>
                    <strong>{{__('subjects.subjectName')}}</strong>
                    <p class="text-muted">{{$subject->name}}</p>

                    <strong>{{__('subjects.subjectGroups')}}</strong>
                    <p class="text-muted">{{$groups}}</p>

                    <strong>{{__('subjects.subjectUsers')}}</strong>
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
