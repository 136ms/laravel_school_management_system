@section('title')
    {{'Edit subject'}}
@endsection
@extends('layouts.app')

@section('content')
    @can('subjects_edit')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>
                            <i class="fas fa-book"></i>
                            {{__('subjects.editSubject')}}
                        </h1>
                    </div>
                </div>
            </div>
        </section>

        <div class="content px-3">

            @include('flash::message')

            <div class="card">

                {!! Form::model($subject, ['route' => ['subjects.update', $subject->id], 'method' => 'patch']) !!}

                <div class="card-body">
                    <div class="row">
                        @include('subjects.fields')
                    </div>
                </div>

                <div class="card-footer">
                    {!! Form::submit(__('subjects.edit'), ['class' => 'btn btn-primary']) !!}
                    <a href="{{ route('subjects.index') }}" class="btn btn-default"> {{__('subjects.cancel')}} </a>
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    @endcan
@endsection
