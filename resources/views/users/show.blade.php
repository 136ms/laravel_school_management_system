@section('title')
    {{$user->fname}} {{$user->lname}}
@endsection
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        <i class="fas fa-user"></i>
                        {{$user->fname}}
                        {{$user->lname}}
                    </h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('users.index') }}">
                        Back
                    </a>
                </div>
            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">About {{$user->fname}} {{$user->lname}}</h3>
                </div>
                <div class="card-body">
                    <strong>First name</strong>
                    <p class="text-muted">{{$user->fname}}</p>
                    <strong>Last name</strong>
                    <p class="text-muted">{{$user->lname}}</p>
                    <strong>Birth date</strong>
                    <p class="text-muted">{{$user->birthdate}}</p>
                    <strong>Address</strong>
                    <p class="text-muted">{{$user->address}}</p>
                    <strong>E-Mail</strong>
                    <p class="text-muted">{{$user->email}}</p>
                    <strong>Gender</strong>
                    <p class="text-muted">{{$user->gender}}</p>
                    <strong>Phone number</strong>
                    <p class="text-muted">{{$user->phonenum}}</p>
                    <strong>Created at</strong>
                    <p class="text-muted">{{$user->created_at}}</p>
                    <strong>Update at</strong>
                    <p class="text-muted">{{$user->updated_at}}</p>
                    <strong>Email verified at</strong>
                    <p class="text-muted">{{$user->email_verified_at}}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
