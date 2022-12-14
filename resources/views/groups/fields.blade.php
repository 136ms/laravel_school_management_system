<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
</div>

<!-- Users Field -->
<div class="form-group col-sm-6">
    {!! Form::label('users', 'Group users:') !!}
    {!! Form::text('users', null, ['class' => 'form-control']) !!}
</div>
