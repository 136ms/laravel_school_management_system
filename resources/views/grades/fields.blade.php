<!-- Fname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('grade', 'Grade:') !!}
    {!! Form::select('grade',[1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5], null,['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('weight', 'Weight:') !!}
    {!! Form::select('weight', ['0.5' => 0.5,'1.0' => 1.0, '1.5' =>1.5,'2.0' => 2.00], null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('users[]', 'Users:') !!}
    {!! Form::select('users[]', $users->pluck('lname', 'id'), null, ['class' => 'form-control', 'multiple'=> 'multiple']) !!}
</div>



