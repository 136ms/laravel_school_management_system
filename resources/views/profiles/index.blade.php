@section('title')
    {{'Profile'}}
@endsection
@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container">
            @include('flash::message')
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{$user->fname}} {{$user->lname}} profile</h1>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img src="/avatars/{{ Auth::user()->avatar }}" class="profile-user-img img-fluid img-circle"
                             alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{$user->fname}} {{$user->lname}}</h3>
                    @can('profile_edit')
                        <a href="{{route('profile.edit', $user)}}" class="btn btn-primary btn-block"><b>Edit</b></a>
                    @endcan
                    @can('profile_edit')
                        <a href="{{route('user.avatar', $user)}}" class="btn btn-primary btn-block"><b>Change Avatar</b></a>
                    @endcan
                    <br>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About {{$user->fname}} {{$user->lname}}</h3>
                        </div>
                        <div class="card-body">
                            @can('profiles_access')
                                <strong><i class="fas fa-id-badge"></i> ID</strong>
                                <p class="text-muted">{{$user->id}}</p>
                                <strong><i class="fas fa-user"></i> First name</strong>
                                <p class="text-muted">{{$user->fname}}</p>
                                <strong><i class="fas fa-user"></i> Last name</strong>
                                <p class="text-muted">{{$user->lname}}</p>
                                <strong><i class="fas fa-birthday-cake"></i> Birth date</strong>
                                <p class="text-muted">{{date_format($user->birthdate, "d.m.Y")}}</p>
                                <strong><i class="fas fa-address-card"></i> Address</strong>
                                <p class="text-muted">{{$user->address}}</p>
                                <strong><i class="fas fa-envelope"></i> E-Mail</strong>
                                <p class="text-muted">{{$user->email}}</p>
                                <strong><i class="fas fa-user"></i> Gender</strong>
                                <p class="text-muted">{{$user->gender}}</p>
                                <strong><i class="fas fa-phone"></i> Phone number</strong>
                                <p class="text-muted">{{$user->phonenum}}</p>
                                <strong><i class="fas fa-user-tie"></i> Roles</strong>
                                <p class="text-muted">{{$roles}}</p>
                            @endcan
                            @can('student_widget')
                                <strong><i class="fas fa-child"></i> Parents</strong>
                                <p class="text-muted">{{$parents}}</p>
                                <strong><i class="fas fa-chalkboard-teacher"></i> Teachers</strong>
                                <p class="text-muted">{{$teachers}}</p>
                            @endcan
                            @can('parent_widget')
                                <strong><i class="fas fa-child"></i> Children</strong>
                                <p class="text-muted">{{$children}}</p>
                            @endcan
                            @can('admin_access')
                                <strong><i class="fas fa-adjust"></i> Permissions</strong>
                                <p class="text-muted">{{$permissions}}</p>
                                <strong><i class="fas fa-users"></i> Groups</strong>
                                <p class="text-muted">{{$groups}}</p>
                                <strong><i class="fas fa-book"></i> Subjects</strong>
                                <p class="text-muted">{{$subjects}}</p>
                                <strong><i class="fas fa-chalkboard-teacher"></i> Teachers</strong>
                                <p class="text-muted">{{$teachers}}</p>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
