@section('title')
    {{$group->name}}
@endsection
@extends('layouts.app')

@section('content')
    @can('groups_show')
        <section class="content-header">
            <div class="container-fluid">
                @include('flash::message')
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
                            {{__('groups.back')}}
                        </a>
                        @can('print_groups')
                            <a class="btn btn-primary float-right mr-1" id="print-button">
                                {{__('groups.print')}}
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card card-primary" id="print-data">
                    <div class="card-header">
                        <h3 class="card-title">{{__('groups.detail')}} {{$group->name}}</h3>
                    </div>
                    <div class="card-body">
                        <strong>{{__('groups.id')}}</strong>
                        <p class="text-muted">{{$group->id}}</p>
                        <strong>{{__('groups.groupName')}}</strong>
                        <p class="text-muted">{{$group->name}}</p>
                        <strong>{{__('groups.groupUsers')}}</strong>
                        <p class="text-muted">{{$users}}</p>
                        <strong>{{__('groups.groupSubjects')}}</strong>
                        <p class="text-muted">{{$subjects}}</p>
                        <strong>{{__('groups.created')}}</strong>
                        <p class="text-muted">{{$group->created_at}}</p>
                        <strong>{{__('groups.updated')}}</strong>
                        <p class="text-muted">{{$group->updated_at}}</p>
                    </div>
                </div>
            </div>
        </section>
    @endcan
    @can('print_groups')
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
