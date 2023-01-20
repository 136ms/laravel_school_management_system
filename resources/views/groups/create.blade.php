@section('title')
    {{'Add group'}}
@endsection
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        <i class="fas fa-users"></i>
                        Add Group
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="card">

            {!! Form::open(['route' => 'groups.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('groups.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Add group', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('groups.index') }}" class="btn btn-default"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
