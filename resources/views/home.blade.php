@section('title'){{'Home'}}@endsection
@extends('layouts.app')
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
                        <h3>{{\App\Models\User::count()}}</h3>
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
                        <h3>{{\App\Models\Subject::count()}}</h3>
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
                        <h3>{{\App\Models\Subject::count()}}</h3>
                        <h5>Classes</h5>
                    </div>
                    <a href="{{route('classes.index')}}">
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
