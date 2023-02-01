@section('title')
    {{'Dashboard'}}
@endsection
@extends('layouts.app')
@section('content')
    @can('dashboard_access')
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
                    @can('student_widget')
                        <div class="col-sm-4">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Grades</h3>
                                </div>
                                @include('grades.table')
                            </div>
                        </div>
                    @endcan
                    <div class="col-sm-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Functions</h3>
                            </div>
                            <div class="card-body">
                                <h5>Lists</h5>
                                @can('subjects_access')
                                    <a href="{{ route('subjects.index', [$subjects]) }}"
                                       class='btn btn-outline-primary'><i class="fas fa-book text-purple"></i>
                                        Subjects
                                    </a>
                                @endcan
                                @can('groups_access')
                                    <a href="{{ route('groups.index', [$groups]) }}"
                                       class='btn btn-outline-primary'><i class="fa fa-users text-info"></i>
                                        Groups
                                    </a>
                                @endcan
                                @can('grades_access')
                                    <a href="{{ route('grades.index', [$grades]) }}"
                                       class='btn btn-outline-primary'><i class="fas fa-graduation-cap text-yellow"></i>
                                        Grades
                                    </a>
                                @endcan
                                @can('children_access')
                                    <a href="{{ route('children.index', [$children]) }}"
                                       class='btn btn-outline-primary'><i class="fas fa-child text-pink"></i>
                                        Children
                                    </a>
                                @endcan
                            </div>
                            <div class="card-body">
                                <h5>Create</h5>
                                @can('subjects_create')
                                    <a href="{{ route('subjects.create', [$subjects]) }}"
                                       class='btn btn-outline-primary'><i class="fa fa-book text-purple"></i>
                                        Subject
                                    </a>
                                @endcan
                                @can('groups_create')
                                    <a href="{{ route('groups.create', [$groups]) }}"
                                       class='btn btn-outline-primary'><i class="fa fa-users text-info"></i>
                                        Group
                                    </a>
                                @endcan
                                @can('grades_create')
                                    <a href="{{ route('grades.create', [$grades]) }}"
                                       class='btn btn-outline-primary'><i class="fas fa-graduation-cap text-yellow"></i>
                                        Grade
                                    </a>
                                @endcan
                                @can('users_create')
                                    <a href="{{ route('users.create', [$user]) }}"
                                       class='btn btn-outline-primary'><i class="fas fa-users text-lime"></i>
                                        User
                                    </a>
                                @endcan
                            </div>
                            <div class="card-body">
                                <h5>User</h5>
                                @can('profiles_access')
                                    <a href="{{ route('profile.index') }}"
                                       class='btn btn-outline-primary'><i class="fa fa-user text-purple"></i>
                                        Profile
                                    </a>
                                @endcan
                                @can('profile_edit')
                                    <a href="{{ route('profile.edit') }}"
                                       class='btn btn-outline-primary'><i class="fa fa-edit text-purple"></i>
                                        Edit profile
                                    </a>
                                @endcan
                                @can('user_picture_edit')
                                    <a href="{{ route('user.avatar') }}"
                                       class='btn btn-outline-primary'><i class="fa fa-edit text-purple"></i>
                                        Profile avatar
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    @endcan
@endsection
