@section('title')
    {{'Dashboard'}}
@endsection
@extends('layouts.app')
@section('content')
    @can('dashboard_access')
        @can('dashboard_access')
            <div class="container">
                @include('flash::message')
                <div class="row pt-3">
                    <div class="col-sm-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{__('dashboard.userDetail')}}</h3>
                            </div>
                            <div class="card-body">
                                <span class="badge bg-primary">{{__('dashboard.fName')}}</span>
                                <p class="text-muted">{{$user->fname}}</p>
                                <span class="badge bg-primary">{{__('dashboard.lName')}}</span>
                                <p class="text-muted">{{$user->lname}}</p>
                                <span class="badge bg-primary">{{__('dashboard.roles')}}</span>
                                <p class="text-muted">{{$roles}}</p>
                                @can('permission_widget')
                                    <span class="badge bg-primary">{{__('dashboard.permissions')}}</span>
                                    <p class="text-muted">{{$permissions}}</p>
                                @endcan
                                @can('student_widget')
                                    <h5 class="text-muted">{{__('dashboard.studentWidget')}}</h5>
                                    <span class="badge bg-primary">{{__('dashboard.groups')}}</span>
                                    <p class="text-muted">{{$groups}}</p>
                                    <span class="badge bg-primary">{{__('dashboard.subjects')}}</span>
                                    <p class="text-muted">{{$subjects}}</p>
                                    <span class="badge bg-primary">{{__('dashboard.teachers')}}</span>
                                    <p class="text-muted">{{$teachers}}</p>
                                    <span class="badge bg-primary">{{__('dashboard.parents')}}</span>
                                    <p class="text-muted">{{$parents}}</p>
                                @endcan
                                @can('teacher_widget')
                                    <h5 class="text-muted">{{__('dashboard.teacherWidget')}}</h5>
                                    <span class="badge bg-primary">{{__('dashboard.groups')}}</span>
                                    <p class="text-muted">{{$groups}}</p>

                                    <span class="badge bg-primary">{{__('dashboard.subjects')}}</span>
                                    <p class="text-muted">{{$subjects}}</p>
                                @endcan
                                @can('parent_widget')
                                    <h5 class="text-muted">{{__('dashboard.parentWidget')}}</h5>
                                    <span class="badge bg-primary">{{__('dashboard.children')}}</span>
                                    <p class="text-muted">{{$children}}</p>
                                @endcan
                            </div>
                        </div>
                    </div>
                    @can('student_widget')
                        <div class="col-sm-4">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">{{__('dashboard.grades')}}</h3>
                                </div>
                                @include('grades.table')
                                <span class="badge bg-primary">{{__('dashboard.gradeAverage')}} {{$userGrades}}</span>
                            </div>
                        </div>
                    @endcan
                    <div class="col-sm-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{__('dashboard.functions')}}</h3>
                            </div>
                            <div class="card-body">
                                <h5>{{__('dashboard.lists')}}</h5>
                                @can('subjects_access')
                                    <a href="{{ route('subjects.index', [$subjects]) }}"
                                       class='btn btn-outline-primary'><i class="fas fa-book text-purple"></i>
                                        {{__('dashboard.subjects')}}
                                    </a>
                                @endcan
                                @can('groups_access')
                                    <a href="{{ route('groups.index', [$groups]) }}"
                                       class='btn btn-outline-primary'><i class="fa fa-users text-info"></i>
                                        {{__('dashboard.groups')}}
                                    </a>
                                @endcan
                                @can('grades_access')
                                    <a href="{{ route('grades.index', [$grades]) }}"
                                       class='btn btn-outline-primary'><i class="fas fa-graduation-cap text-yellow"></i>
                                        {{__('dashboard.grades')}}
                                    </a>
                                @endcan
                                @can('children_access')
                                    <a href="{{ route('children.index', [$children]) }}"
                                       class='btn btn-outline-primary'><i class="fas fa-child text-pink"></i>
                                        {{__('dashboard.children')}}
                                    </a>
                                @endcan
                            </div>
                            <div class="card-body">
                                <h5>{{__('dashboard.create')}}</h5>
                                @can('subjects_create')
                                    <a href="{{ route('subjects.create', [$subjects]) }}"
                                       class='btn btn-outline-primary'><i class="fa fa-book text-purple"></i>
                                        {{__('dashboard.singleSubject')}}
                                    </a>
                                @endcan
                                @can('groups_create')
                                    <a href="{{ route('groups.create', [$groups]) }}"
                                       class='btn btn-outline-primary'><i class="fa fa-users text-info"></i>
                                        {{__('dashboard.singleGroup')}}
                                    </a>
                                @endcan
                                @can('grades_create')
                                    <a href="{{ route('grades.create', [$grades]) }}"
                                       class='btn btn-outline-primary'><i class="fas fa-graduation-cap text-yellow"></i>
                                        {{__('dashboard.singleGrade')}}
                                    </a>
                                @endcan
                                @can('users_create')
                                    <a href="{{ route('users.create', [$user]) }}"
                                       class='btn btn-outline-primary'><i class="fas fa-users text-lime"></i>
                                        {{__('dashboard.singleUser')}}
                                    </a>
                                @endcan
                            </div>
                            <div class="card-body">
                                <h5>{{__('dashboard.singleUser')}}</h5>
                                @can('profiles_access')
                                    <a href="{{ route('profile.index') }}"
                                       class='btn btn-outline-primary'><i class="fa fa-user text-red"></i>
                                        {{__('dashboard.profile')}}
                                    </a>
                                @endcan
                                @can('profile_edit')
                                    <a href="{{ route('profile.edit') }}"
                                       class='btn btn-outline-primary'><i class="fa fa-edit text-red"></i>
                                        {{__('dashboard.editProfile')}}
                                    </a>
                                @endcan
                                @can('user_picture_edit')
                                    <a href="{{ route('user.avatar') }}"
                                       class='btn btn-outline-primary'><i class="fa fa-edit text-red"></i>
                                        {{__('dashboard.profileAvatar')}}
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
