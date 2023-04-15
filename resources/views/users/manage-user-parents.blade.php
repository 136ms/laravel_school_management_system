@section('title')
    {{__('titles.edit')}}
@endsection
@extends('layouts.app')

@section('content')
    @can('users_parents_edit')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>
                            <i class="fas fa-user"></i>
                            {{__('users.userManageParents')}}
                        </h1>
                    </div>
                </div>
            </div>
        </section>

        <div class="content px-3">

            @include('flash::message')
            <div class="card">
                {!! Form::open(['route' => ['users.parents.update',$user->id ], 'method' => 'patch']) !!}
                <div class="card-body">
                    <div class="row">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="form-group">
                            <h5>{{$user->fname}} {{$user->lname}}</h5>
                            {!! Form::label('parents[]', __('users.userManageParents')) !!}
                            {!! Form::select('parents[]', $parents->pluck('lname', 'id'), $user->parents->pluck('id'), ['class' => 'form-control', 'multiple'=> 'multiple']) !!}
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    {!! Form::submit(__('users.parentSubmit'), ['class' => 'btn btn-primary']) !!}
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-default"> {{__('users.userCancel')}} </a>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    @endcan
@endsection
