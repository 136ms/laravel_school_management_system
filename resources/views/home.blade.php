@extends('layouts.app')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Overview</h1>
                </div>
            </div>
            <div class="row">
                <div class="small-box bg-gradient-lime m-2 col-lg-2">
                    <div class="inner">
                        <h3>{{\App\Models\User::count()}}</h3>
                        <h5>Users</h5>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="small-box bg-gradient-purple m-2 col-lg-2">
                    <div class="inner">
                        <h3>{{\App\Models\Subject::count()}}</h3>
                        <h5>Subjects</h5>
                    </div>
                    <div class="icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
