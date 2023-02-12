<!-- Fname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fname', __('users.fName')) !!}
    {!! Form::text('fname', null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
</div>

<!-- Lname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lname', __('users.lName')) !!}
    {!! Form::text('lname', null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
</div>

<!-- Birthdate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('birthdate', __('users.bDate')) !!}
    {!! Form::text('birthdate', null, ['class' => 'form-control','id'=>'birthdate']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#birthdate').datepicker()
    </script>
@endpush

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', __('users.address')) !!}
    {!! Form::text('address', null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', __('users.email')) !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Gender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gender', __('users.gender')) !!}
    {!! Form::select('gender',array('Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other'),null,['class' => 'form-control']) !!}
</div>

<!-- Phonenum Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phonenum', __('users.phone')) !!}
    {!! Form::text('phonenum', null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
</div>

<!-- password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', __('users.newPass')) !!}
    {!! Form::password('password' ,['class' => 'form-control', 'required']) !!}
</div>

