@section('title')
    {{$user->fname}} {{$user->lname}}
@endsection
@extends('layouts.app')
@section('content')
    <div class="content-header">
        @include('flash::message')
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{$user->fname}} {{$user->lname}} {{__('profile.profile')}}</h1>
                </div>
                @can('print_profiles')
                <a class="btn btn-primary float-right mr-1" id="print-button">
                    {{__('profile.profilePrint')}}
                </a>
                @endcan
            </div>
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img src="/avatars/{{ $user->avatar }}" class="profile-user-img img-fluid img-circle"
                             alt="User profile picture">

                    </div>
                    <h3 class="profile-username text-center">{{$user->fname}} {{$user->lname}}</h3>
                    <a href="{{route('profiles.edit', $user)}}" class="btn btn-primary btn-block"><b>{{__('profile.editButton')}}</b></a>
                    <br>
                    <div class="card card-primary" id="print-data">
                        <div class="card-header">
                            <h3 class="card-title">{{__('profile.detail')}} {{$user->fname}} {{$user->lname}}</h3>
                        </div>
                        <div class="card-body">
                            <strong><i class="fas fa-user"></i> {{__('profile.profileId')}}</strong>
                            <p class="text-muted">{{$user->id}}</p>
                            <strong><i class="fas fa-user"></i> {{__('profile.profileFname')}}</strong>
                            <p class="text-muted">{{$user->fname}}</p>
                            <strong><i class="fas fa-user"></i> {{__('profile.profileLname')}}</strong>
                            <p class="text-muted">{{$user->lname}}</p>
                            <strong><i class="fas fa-user"></i> {{__('profile.profileBirthDate')}}</strong>
                            <p class="text-muted">{{date_format($user->birthdate, "d.m.Y")}}</p>
                            <strong><i class="fas fa-user"></i> {{__('profile.profileAddress')}}</strong>
                            <p class="text-muted">{{$user->address}}</p>
                            <strong><i class="fas fa-user"></i> {{__('profile.profileEmail')}}</strong>
                            <p class="text-muted">{{$user->email}}</p>
                            <strong><i class="fas fa-user"></i> {{__('profile.profileGender')}}</strong>
                            <p class="text-muted">{{$user->gender}}</p>
                            <strong><i class="fas fa-user"></i> {{__('profile.profilePhoneNum')}}</strong>
                            <p class="text-muted">{{$user->phonenum}}</p>
                            <strong><i class="fas fa-user"></i> {{__('profile.profileRoles')}}</strong>
                            <p class="text-muted">{{$roles}}</p>
                            @can('admin_access')
                                <strong><i class="fas fa-user"></i> {{__('profile.profilePermissions')}}</strong>
                                <p class="text-muted">{{$permissions}}</p>
                                <strong><i class="fas fa-user"></i> {{__('profile.profileGroups')}}</strong>
                                <p class="text-muted">{{$groups}}</p>
                                <strong><i class="fas fa-user"></i> {{__('profile.profileSubjects')}}</strong>
                                <p class="text-muted">{{$subjects}}</p>
                                <strong><i class="fas fa-user"></i> {{__('profile.profileTeachers')}}</strong>
                                <p class="text-muted">{{$teachers}}</p>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @can('print_profiles')
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
