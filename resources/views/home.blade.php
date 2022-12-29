@section('title')
    {{'Home'}}
@endsection
@extends('layouts.app')
@section('content')
    <p class="m-0"><i class="fas fa-user-tie"></i> {{$user->roles[0]->name}}</p>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-home"></i> Home</h1>
                </div>
            </div>
            <div class="row">
                <a href="{{route('profile.index')}}" class="btn btn-app">
                    <i class="fas fa-user"></i> Profile
                </a>
                @can('admin_access')
                    <div class="small-box bg-gradient-lime m-2 col-lg-2">
                        <div class="inner">
                            <h3>{{$users}}</h3>
                            <h5>Users</h5>
                        </div>
                        <a href="{{route('users.index')}}">
                            <div class="icon">
                                <i class="fas fa-user"></i>
                            </div>
                        </a>
                    </div>
                    <div class="small-box bg-gradient-purple m-2 col-lg-2">
                        <div class="inner">
                            <h3>{{$subjects}}</h3>
                            <h5>Subjects</h5>
                        </div>
                        <a href="{{route('subjects.index')}}">
                            <div class="icon">
                                <i class="fas fa-book"></i>
                            </div>
                        </a>
                    </div>
                    <div class="small-box bg-gradient-info m-2 col-lg-2">
                        <div class="inner">
                            <h3>{{$groups}}</h3>
                            <h5>Groups</h5>
                        </div>
                        <a href="{{route('groups.index')}}">
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                        </a>
                    </div>
                    <div class="small-box bg-gradient-maroon m-2 col-lg-2">
                        <div class="inner">
                            <h3>{{$parents}}</h3>
                            <h5>Parents</h5>
                        </div>
                        <a href="{{route('users.index')}}">
                            <div class="icon">
                                <i class="fas fa-hand-holding-heart"></i>
                            </div>
                        </a>
                    </div>
                    <div class="small-box bg-gradient-orange m-2 col-lg-2">
                        <div class="inner">
                            <h3>{{$teachers}}</h3>
                            <h5>Teachers</h5>
                        </div>
                        <a href="{{route('users.index')}}">
                            <div class="icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-6">
                        <h1 class="m-0"> Users</h1>
                    </div>

                    <a href="{{route('users.create')}}" class="btn btn-app">
                        <i class="fas fa-plus"></i> Create User
                    </a>

                    <a href="{{route('users.index')}}" class="btn btn-app">
                        <i class="fas fa-list"></i> Users List
                    </a>

                    <div class="col-sm-6">
                        <h1 class="m-0"> Subjects</h1>
                    </div>

                    <a href="{{route('subjects.create')}}" class="btn btn-app">
                        <i class="fas fa-plus"></i> Create Subject
                    </a>

                    <a href="{{route('subjects.index')}}" class="btn btn-app">
                        <i class="fas fa-list"></i> Subject List
                    </a>

                    <div class="col-sm-6">
                        <h1 class="m-0"> Groups</h1>
                    </div>

                    <a href="{{route('groups.create')}}" class="btn btn-app">
                        <i class="fas fa-plus"></i> Create Group
                    </a>
                    <a href="{{route('groups.index')}}" class="btn btn-app">
                        <i class="fas fa-list"></i> Group List
                    </a>
                @endcan
            </div>
        </div>
    </div>
@endsection
