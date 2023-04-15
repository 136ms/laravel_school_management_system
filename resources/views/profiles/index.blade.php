@section('title')
    {{__('titles.profile')}}
@endsection
@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container">
            @include('flash::message')
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{$user->fname}} {{$user->lname}} {{__('profile.profile')}}</h1>
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
                        <a href="{{route('profile.edit', $user)}}" class="btn btn-primary btn-block"><b>{{__('profile.editButton')}}</b></a>
                    @endcan
                    @can('profile_edit')
                        <a href="{{route('user.avatar', $user)}}" class="btn btn-primary btn-block"><b>{{__('profile.editAvatar')}}</b></a>
                    @endcan
                    <br>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{__('profile.detail')}} {{$user->fname}} {{$user->lname}}</h3>
                        </div>
                        <div class="card-body">
                            @can('profiles_access')
                                <strong><i class="fas fa-id-badge"></i> {{__('profile.profileId')}}</strong>
                                <p class="text-muted">{{$user->id}}</p>
                                <strong><i class="fas fa-user"></i> {{__('profile.profileFname')}}</strong>
                                <p class="text-muted">{{$user->fname}}</p>
                                <strong><i class="fas fa-user"></i> {{__('profile.profileLname')}}</strong>
                                <p class="text-muted">{{$user->lname}}</p>
                                <strong><i class="fas fa-birthday-cake"></i> {{__('profile.profileBirthDate')}}</strong>
                                <p class="text-muted">{{date_format($user->birthdate, "d.m.Y")}}</p>
                                <strong><i class="fas fa-address-card"></i> {{__('profile.profileAddress')}}</strong>
                                <p class="text-muted">{{$user->address}}</p>
                                <strong><i class="fas fa-envelope"></i> {{__('profile.profileEmail')}}</strong>
                                <p class="text-muted">{{$user->email}}</p>
                                <strong><i class="fas fa-user"></i> {{__('profile.profileGender')}}</strong>
                                <p class="text-muted">{{$user->gender}}</p>
                                <strong><i class="fas fa-phone"></i> {{__('profile.profilePhoneNum')}}</strong>
                                <p class="text-muted">{{$user->phonenum}}</p>
                                <strong><i class="fas fa-user-tie"></i> {{__('profile.profileRoles')}}</strong>
                                <p class="text-muted">{{$roles}}</p>
                            @endcan
                            @can('student_widget')
                                <strong><i class="fas fa-child"></i> {{__('profile.profileParents')}}</strong>
                                <p class="text-muted">{{$parents}}</p>
                                <strong><i class="fas fa-chalkboard-teacher"></i> {{__('profile.profileTeachers')}}</strong>
                                <p class="text-muted">{{$teachers}}</p>
                            @endcan
                            @can('parent_widget')
                                <strong><i class="fas fa-child"></i> {{__('profile.profileChildren')}}</strong>
                                <p class="text-muted">{{$children}}</p>
                            @endcan
                            @can('admin_access')
                                <strong><i class="fas fa-adjust"></i> {{__('profile.profilePermissions')}}</strong>
                                <p class="text-muted">{{$permissions}}</p>
                                <strong><i class="fas fa-users"></i> {{__('profile.profileGroups')}}</strong>
                                <p class="text-muted">{{$groups}}</p>
                                <strong><i class="fas fa-book"></i> {{__('profile.profileSubjects')}}</strong>
                                <p class="text-muted">{{$subjects}}</p>
                                <strong><i class="fas fa-chalkboard-teacher"></i> {{__('profile.profileTeachers')}}</strong>
                                <p class="text-muted">{{$teachers}}</p>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
