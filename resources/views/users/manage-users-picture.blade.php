@section('title')
    {{'Manage users profile picture'}}
@endsection
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        <i class="fas fa-user"></i>
                        Update {{$user->fname}} {{$user->lname}}'s profile picture
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <div class="col-sm-12">
        @include('flash::message')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Upload profile picture</h3>
            </div>
            <form action="{{route('users.avatar.update' , $user->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputFile">Picture upload</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="avatar">
                                <label class="custom-file-label" for="avatar">Choose picture</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

@endsection
