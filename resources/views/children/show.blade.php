@section('title')
    {{'Children'}}
@endsection
@extends('layouts.app')

@section('content')
    @can('children_access')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            <i class="fas fa-user"></i>
                            {{$children->fullName}}
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <a class="btn btn-default float-right"
                           href="{{ route('children.index') }}">
                            {{__('children.back')}}
                        </a>
                        @can('print_children')
                            <a class="btn btn-primary float-right mr-1" id="print-button">
                                {{__('children.print')}}
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{__('children.detail')}} {{$children->fullName}}</h3>
                    </div>
                    <div class="card-body" id="print-data">
                        @include('flash::message')
                        <img src="/avatars/{{ $children->avatar }}" class="user-image img-circle elevation-2"
                             style="width: 5%"
                             alt="User profile picture">
                        <br>
                        <strong>{{__('children.id')}}</strong>
                        <p class="text-muted">{{$children->id}}</p>

                        <strong>{{__('children.childGroups')}}</strong>
                        <p class="text-muted">{{$groups}}</p>

                        <strong>{{__('children.childSubjects')}}</strong>
                        <p class="text-muted">{{$subjects}}</p>

                        <strong>{{__('children.childTeachers')}}</strong>
                        <p class="text-muted">{{$teachers}}</p>

                        <strong>{{__('children.fName')}}</strong>
                        <p class="text-muted">{{$children->fname}}</p>
                        <strong>{{__('children.lName')}}</strong>
                        <p class="text-muted">{{$children->lname}}</p>
                        <strong>{{__('children.bDate')}}</strong>
                        <p class="text-muted">{{date_format($children->birthdate, "d.m.Y")}}</p>
                        <strong>{{__('children.address')}}</strong>
                        <p class="text-muted">{{$children->address}}</p>
                        <strong>{{__('children.email')}}</strong>
                        <p class="text-muted">{{$children->email}}</p>
                        <strong>{{__('children.gender')}}</strong>
                        <p class="text-muted">{{$children->gender}}</p>
                        <strong>{{__('children.phone')}}</strong>
                        <p class="text-muted">{{$children->phonenum}}</p>
                        <strong>{{__('children.created')}}</strong>
                        <p class="text-muted">{{$children->created_at}}</p>
                        <strong>{{__('children.updated')}}</strong>
                        <p class="text-muted">{{$children->updated_at}}</p>
                        <strong>{{__('children.emailVerified')}}</strong>
                        <p class="text-muted">{{$children->email_verified_at}}</p>
                        <strong>{{__('children.childGrades')}}</strong>
                        <div class="table-responsive">
                            <table class="table" id="users-table">
                                <thead>
                                <tr>
                                    <th>{{__('children.id')}}</th>
                                    <th>{{__('children.grade')}}</th>
                                    <th>{{__('children.weight')}}</th>
                                    <th>{{__('children.name')}}</th>
                                    <th>{{__('children.author')}}</th>
                                    <th>{{__('children.subject')}}</th>
                                    <th>{{__('children.created')}}</th>
                                    <th>{{__('children.updated')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($grades as $grade)
                                    <tr>
                                        @include('flash::message')
                                        <td>{{ $grade->id }}.</td>
                                        <td>{{ $grade->grade }}</td>
                                        <td>{{ $grade->weight }}</td>
                                        <td>{{ $grade->name }}</td>
                                        <td>{{ $grade->author->fullName }}</td>
                                        <td>{{ $grade->subject->name }}</td>
                                        <td>{{ $grade->created_at }}</td>
                                        <td>{{ $grade->updated_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endcan
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
