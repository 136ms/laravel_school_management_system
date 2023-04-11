<!-- Fname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('grades.name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('grade', __('grades.grade')) !!}
    {!! Form::select('grade',[1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5], null,['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('weight', __('grades.weight')) !!}
    {!! Form::select('weight', ['0.5' => 0.5,'1.0' => 1.0, '1.5' =>1.5,'2.0' => 2.00], null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('user_id', __('grades.student')) !!}
    {!! Form::select('user_id', $students->pluck('lname', 'id'), null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('subject_id', __('grades.subject')) !!}
    {!! Form::select('subject_id', $subjects->pluck('name', 'id'), null, ['class' => 'form-control']) !!}
</div>



