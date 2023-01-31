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
                            Back
                        </a>
                        @can('print_children')
                            <a class="btn btn-primary float-right mr-1" id="print-button">
                                Print
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About {{$children->fullName}}</h3>
                    </div>
                    <div class="card-body" id="print-data">
                        @include('flash::message')
                        <img src="/avatars/{{ $children->avatar }}" class="user-image img-circle elevation-2"
                             style="width: 5%"
                             alt="User profile picture">
                        <br>
                        <strong>ID</strong>
                        <p class="text-muted">{{$children->id}}</p>

                        <strong>Groups</strong>
                        <p class="text-muted">{{$groups}}</p>

                        <strong>Subjects</strong>
                        <p class="text-muted">{{$subjects}}</p>

                        <strong>Teachers</strong>
                        <p class="text-muted">{{$teachers}}</p>

                        <strong>First name</strong>
                        <p class="text-muted">{{$children->fname}}</p>
                        <strong>Last name</strong>
                        <p class="text-muted">{{$children->lname}}</p>
                        <strong>Birth date</strong>
                        <p class="text-muted">{{date_format($children->birthdate, "d.m.Y")}}</p>
                        <strong>Address</strong>
                        <p class="text-muted">{{$children->address}}</p>
                        <strong>E-Mail</strong>
                        <p class="text-muted">{{$children->email}}</p>
                        <strong>Gender</strong>
                        <p class="text-muted">{{$children->gender}}</p>
                        <strong>Phone number</strong>
                        <p class="text-muted">{{$children->phonenum}}</p>
                        <strong>Created at</strong>
                        <p class="text-muted">{{$children->created_at}}</p>
                        <strong>Update at</strong>
                        <p class="text-muted">{{$children->updated_at}}</p>
                        <strong>Email verified at</strong>
                        <p class="text-muted">{{$children->email_verified_at}}</p>
                        <strong>Grades</strong>
                        <div class="table-responsive">
                            <table class="table" id="users-table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Grade</th>
                                    <th>Weight</th>
                                    <th>Name</th>
                                    <th>Author</th>
                                    <th>Subject</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
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
