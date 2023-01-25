@section('title')
    {{'Manage group subjects'}}
@endsection
@extends('layouts.app')

@section('content')
    @can('groups_subjects_edit')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>
                            <i class="fas fa-user"></i>
                            Manage group subjects
                        </h1>
                    </div>
                </div>
            </div>
        </section>

        <div class="content px-3">

            @include('flash::message')
            <div class="card">
                {!! Form::open(['route' => ['groups.subjects.update',$group->id ], 'method' => 'patch']) !!}
                <div class="card-body">
                    <div class="row">
                        @csrf
                        <input type="hidden" name="group_id" value="{{ $group->id }}">
                        <div class="form-group">
                            <h5>{{$group->name}}</h5>
                            {!! Form::label('subjects[]', 'Update subjects:') !!}
                            {!! Form::select('subjects[]', $subjects->pluck('name', 'id'), $group->subjects->pluck('id'), ['class' => 'form-control', 'multiple'=> 'multiple']) !!}
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                    <a href="{{ route('groups.edit', $group) }}" class="btn btn-default"> Cancel </a>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    @endcan
@endsection
