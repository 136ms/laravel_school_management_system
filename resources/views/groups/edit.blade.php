@section('title')
    {{'Edit group'}}
@endsection
@extends('layouts.app')

@section('content')
    @can('groups_edit')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>
                            <i class="fas fa-users"></i>
                            {{__('groups.editGroup')}}
                        </h1>
                    </div>
                </div>
            </div>
        </section>

        <div class="content px-3">

            @include('flash::message')
            @can('group_users_update')
                <a href="{{ route('groups.users.show', $group->id) }}" class="btn btn-primary"> {{__('groups.manageUsers')}} </a>
            @endcan
            @can('group_subjects_update')
                <a href="{{ route('groups.subjects.show', $group->id) }}" class="btn btn-primary"> {{__('groups.manageSubjects')}} </a>
            @endcan

            <div class="card">

                {!! Form::model($group, ['route' => ['groups.update', $group->id], 'method' => 'patch']) !!}

                <div class="card-body">
                    <div class="row">
                        @include('groups.fields')
                    </div>
                </div>

                <div class="card-footer">
                    {!! Form::submit(__('subjects.edit'), ['class' => 'btn btn-primary']) !!}
                    <a href="{{ route('groups.index') }}" class="btn btn-default"> {{__('subjects.cancel')}} </a>
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    @endcan
@endsection
