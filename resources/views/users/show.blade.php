@section('title')
    {{$user->fullName}}
@endsection
@extends('layouts.app')

@section('content')
    @can('users_show')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            <i class="fas fa-user"></i>
                            {{$user->fullName}}
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <a class="btn btn-default float-right"
                           href="{{ route('users.index') }}">
                            {{__('users.userBack')}}
                        </a>
                        @can('print_users')
                            <a class="btn btn-primary float-right mr-1" id="print-button">
                                {{__('users.userPrint')}}
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{__('users.detail')}} {{$user->fname}} {{$user->lname}}</h3>
                    </div>
                    <div class="card-body" id="print-data">
                        @include('flash::message')
                        <img src="/avatars/{{ $user->avatar }}" class="user-image img-circle elevation-2"
                             style="width: 5%"
                             alt="User profile picture">
                        <br>
                        <strong>{{__('users.iD')}}</strong>
                        <p class="text-muted">{{$user->id}}</p>

                        <strong>{{__('users.parents')}}</strong>
                        <p class="text-muted">{{$parents}}</p>

                        <strong>{{__('users.groups')}}</strong>
                        <p class="text-muted">{{$groups}}</p>

                        <strong>{{__('users.subjects')}}</strong>
                        <p class="text-muted">{{$subjects}}</p>

                        <strong>{{__('users.teachers')}}</strong>
                        <p class="text-muted">{{$teachers}}</p>

                        <strong>{{__('users.fName')}}</strong>
                        <p class="text-muted">{{$user->fname}}</p>
                        <strong>{{__('users.lName')}}</strong>
                        <p class="text-muted">{{$user->lname}}</p>
                        <strong>{{__('users.bDate')}}</strong>
                        <p class="text-muted">{{date_format($user->birthdate, "d.m.Y")}}</p>
                        <strong>{{__('users.address')}}</strong>
                        <p class="text-muted">{{$user->address}}</p>
                        <strong>{{__('users.email')}}</strong>
                        <p class="text-muted">{{$user->email}}</p>
                        <strong>{{__('users.gender')}}</strong>
                        <p class="text-muted">{{$user->gender}}</p>
                        <strong>{{__('users.phone')}}</strong>
                        <p class="text-muted">{{$user->phonenum}}</p>
                        <strong>{{__('users.created')}}</strong>
                        <p class="text-muted">{{$user->created_at}}</p>
                        <strong>{{__('users.updated')}}</strong>
                        <p class="text-muted">{{$user->updated_at}}</p>
                        <strong>{{__('users.emailVerified')}}</strong>
                        <p class="text-muted">{{$user->email_verified_at}}</p>
                    </div>
                </div>
            </div>
        </section>
    @endcan
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
@endsection
