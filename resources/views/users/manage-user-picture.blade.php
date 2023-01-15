@section('title')
    {{'Manage teachers'}}
@endsection
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        <i class="fas fa-user"></i>
                        Manage user teachers
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')
        <div class="card">
            <form action="{{route('users.pictures.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="avatar">
                <input type="submit" value="Upload">
            </form>
        </div>
    </div>
@endsection
