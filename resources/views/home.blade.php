@section('title'){{'Home'}}@endsection
@extends('layouts.app')
@can('admin_access')
    @section('content')
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fas fa-home"></i> Home</h1>
                    </div>
                </div>
                <div class="row">
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
                </div>
            </div>
        </div>
    @endsection
@endcan
@can('student_access')
    @section('content')
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fas fa-home"></i> Home</h1>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endcan
@can('teacher_access')
    @section('content')
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fas fa-home"></i> Home</h1>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endcan
@can('parent_access')
    @section('content')
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fas fa-home"></i> Home</h1>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endcan
