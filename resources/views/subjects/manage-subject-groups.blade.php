@section('title')
    {{__('titles.edit')}}
@endsection
@extends('layouts.app')

@section('content')
    @can('subjects_groups_edit')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>
                            <i class="fas fa-user"></i>
                            {{__('subjects.manageSubjectGroup')}}
                        </h1>
                    </div>
                </div>
            </div>
        </section>

        <div class="content px-3">

            @include('flash::message')
            <div class="card">
                {!! Form::open(['route' => ['subjects.groups.update',$subject->id ], 'method' => 'patch']) !!}
                <div class="card-body">
                    <div class="row">
                        @csrf
                        <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                        <div class="form-group">
                            <h5>{{$subject->name}}</h5>
                            {!! Form::label('groups[]', __('subjects.updateGroups')) !!}
                            {!! Form::select('groups[]', $groups->pluck('name', 'id'), $subject->groups->pluck('id'), ['class' => 'form-control', 'multiple'=> 'multiple']) !!}
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    {!! Form::submit(__('subjects.update'), ['class' => 'btn btn-primary']) !!}
                    <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-default"> {{__('subjects.cancel')}} </a>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    @endcan
@endsection
