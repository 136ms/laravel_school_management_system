@section('title')
    {{'Edit group'}}
@endsection
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        <i class="fas fa-users"></i>
                        Edit Group
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')
        @can('group_users_update')
            <a href="{{ route('groups.users.show', $group->id) }}" class="btn btn-primary"> Manage users </a>
        @endcan
        @can('group_subjects_update')
            <a href="{{ route('groups.subjects.show', $group->id) }}" class="btn btn-primary"> Manage subjects </a>
        @endcan

        <div class="card">

            {!! Form::model($group, ['route' => ['groups.update', $group->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('groups.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('groups.index') }}" class="btn btn-default"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
