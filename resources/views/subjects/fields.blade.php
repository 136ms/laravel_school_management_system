<!-- Subject Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('subjects.name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
</div>
