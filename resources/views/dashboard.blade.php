@section('title')
    {{'Dashboard'}}
@endsection
@extends('layouts.app')
@section('content')
    @can('dashboard_access')
        <div class="container">
            <div class="row pt-3">
                <div class="col-sm-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">User details</h3>
                        </div>
                        <div class="card-body">
                            <span class="badge bg-primary">First name</span>
                            <p class="text-muted">{{$user->fname}}</p>
                            <span class="badge bg-primary">Last name</span>
                            <p class="text-muted">{{$user->lname}}</p>
                            <span class="badge bg-primary">Roles</span>
                            <p class="text-muted">{{$roles}}</p>
                            @can('student_access')
                                <h5 class="text-muted">Student widgets</h5>
                                <span class="badge bg-primary">Groups</span>
                                <p class="text-muted">{{$groups}}</p>
                                <span class="badge bg-primary">Subjects</span>
                                <p class="text-muted">{{$subjects}}</p>
                                <span class="badge bg-primary">Teachers</span>
                                <p class="text-muted">{{$teachers}}</p>
                                <span class="badge bg-primary">Parents</span>
                                <p class="text-muted">{{$parents}}</p>
                            @endcan
                            @can('teacher_access')
                                <h5 class="text-muted">Teacher widgets</h5>
                                <span class="badge bg-primary">Groups</span>
                                <p class="text-muted">{{$groups}}</p>

                                <span class="badge bg-primary">Subjects</span>
                                <p class="text-muted">{{$subjects}}</p>
                            @endcan
                            @can('parent_access')
                                <h5 class="text-muted">Parent widgets</h5>
                                <span class="badge bg-primary">Children</span>
                                <p class="text-muted">{{$children}}</p>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Dashboard</h3>
                        </div>
                        <div class="card-body">
                            @can('admin_access')
                                <h6>Users: {{$userCount}}</h6>
                                <h6>Subjects: {{$subjectCount}}</h6>
                                <h6>Groups: {{$groupCount}}</h6>
                            @endcan
                            @can('users_access')
                                <a href="{{route('users.index')}}">
                                    <button type="button" class="btn bg-gradient-primary btn-sm">Show users</button>
                                </a>
                            @endcan
                            @can('users_create')
                                <a href="{{route('users.create')}}">
                                    <button type="button" class="btn bg-gradient-primary btn-sm">Add user</button>
                                </a>
                            @endcan
                            @can('subjects_access')
                                <a href="{{route('subjects.index')}}">
                                    <button type="button" class="btn bg-gradient-primary btn-sm">Show subjects</button>
                                </a>
                            @endcan
                            @can('subjects_create')
                                <a href="{{route('subjects.create')}}">
                                    <button type="button" class="btn bg-gradient-primary btn-sm">Add subject</button>
                                </a>
                            @endcan
                            @can('groups_access')
                                <a href="{{route('groups.index')}}">
                                    <button type="button" class="btn bg-gradient-primary btn-sm">Show groups</button>
                                </a>
                            @endcan
                            @can('groups_create')
                                <a href="{{route('groups.create')}}">
                                    <button type="button" class="btn bg-gradient-primary btn-sm">Add group</button>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
