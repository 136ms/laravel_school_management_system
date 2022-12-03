@section('title')
    {{$user->fname}} {{$user->lname}}
@endsection
@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{$user->fname}} {{$user->lname}} profile</h1>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                             src="https://assets.infyom.com/logo/blue_logo_150x150.png"
                             alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{$user->fname}} {{$user->lname}}</h3>
                    <p class="text-muted text-center">4.AI</p>
                    <a href="/users/{{$user->id}}/edit" class="btn btn-primary btn-block"><b>Edit</b></a>
                    <a href="#" class="btn btn-primary btn-block"><b>Action button</b></a>
                    <a href="#" class="btn btn-primary btn-block"><b>Action button</b></a>
                    <br>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About {{$user->fname}} {{$user->lname}}</h3>
                        </div>
                        <div class="card-body">
                            <strong><i class="fas fa-user"></i> First name</strong>
                            <p class="text-muted">{{$user->fname}}</p>
                            <strong><i class="fas fa-user"></i> Last name</strong>
                            <p class="text-muted">{{$user->lname}}</p>
                            <strong><i class="fas fa-user"></i> Birth date</strong>
                            <p class="text-muted">{{date_format($user->birthdate, "d.m.Y")}}</p>
                            <strong><i class="fas fa-user"></i> Address</strong>
                            <p class="text-muted">{{$user->address}}</p>
                            <strong><i class="fas fa-user"></i> E-Mail</strong>
                            <p class="text-muted">{{$user->email}}</p>
                            <strong><i class="fas fa-user"></i> Gender</strong>
                            <p class="text-muted">{{$user->gender}}</p>
                            <strong><i class="fas fa-user"></i> Phone number</strong>
                            <p class="text-muted">{{$user->phonenum}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
