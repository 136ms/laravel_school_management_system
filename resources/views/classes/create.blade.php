@section('title'){{'Add class'}}@endsection
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1><i class="fas fa-users"></i>
                    Create Class
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'classes.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('classes.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('classes.index') }}" class="btn btn-default"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
