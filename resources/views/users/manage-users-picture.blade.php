@section('title')
    {{'Manage users profile picture'}}
@endsection
@extends('layouts.app')

@section('content')
    @can('users_picture_edit')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>
                            <i class="fas fa-user"></i>
                            {{__('users.userManageAvatar')}} {{$user->fname}} {{$user->lname}}
                        </h1>
                    </div>
                </div>
            </div>
        </section>
        <div class="col-sm-12">
            @include('flash::message')
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{__('users.uploadPicture')}}</h3>
                </div>
                <form action="{{route('users.avatar.update' , $user->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <img src="/avatars/{{ $user->avatar }}" class="user-image img-circle elevation-2"
                                 style="width: 50px" alt="User profile picture">
                            <br>
                            <label for="exampleInputFile">{{__('users.uploadPicture')}}</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="avatar">
                                    <label class="custom-file-label" for="avatar">{{__('users.userManageAvatar')}}</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{__('users.submitPicture')}}</button>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-default"> {{__('users.userCancel')}} </a>
                    </div>
                </form>
            </div>
        </div>
    @endcan
@endsection
