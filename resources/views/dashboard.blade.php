@section('title')
    {{'Dashboard'}}
@endsection
@extends('layouts.app')
@section('content')
    @can('dashboard_access')
        <div class="container">
            <div class="row pt-3">
                @include('flash::message')
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
                            @can('permission_widget')
                            <span class="badge bg-primary">Permissions</span>
                            <p class="text-muted">{{$permissions}}</p>
                            @endcan
                            @can('student_widget')
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
                            @can('teacher_widget')
                                <h5 class="text-muted">Teacher widgets</h5>
                                <span class="badge bg-primary">Groups</span>
                                <p class="text-muted">{{$groups}}</p>

                                <span class="badge bg-primary">Subjects</span>
                                <p class="text-muted">{{$subjects}}</p>
                            @endcan
                            @can('parent_widget')
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

                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
