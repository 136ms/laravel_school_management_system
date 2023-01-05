<!-- Fname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fname', 'First name:') !!}
    {!! Form::text('fname', null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
</div>

<!-- Lname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lname', 'Last name:') !!}
    {!! Form::text('lname', null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
</div>

<!-- Birthdate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('birthdate', 'Birth date:') !!}
    {!! Form::text('birthdate', null, ['class' => 'form-control','id'=>'birthdate']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#birthdate').datepicker()
    </script>
@endpush

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::text('address', null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'E-mail:') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Gender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gender', 'Gender:') !!}
    {!! Form::select('gender',array('Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other'),null,['class' => 'form-control']) !!}
</div>

<!-- Phonenum Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phonenum', 'Phone number:') !!}
    {!! Form::text('phonenum', null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
</div>

<!-- password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'New password:') !!}
    {!! Form::password('password' ,['class' => 'form-control', 'required']) !!}
</div>

<!-- password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('roles', 'Choose role:') !!}
    {!! Form::select('roles',$roles,null,['class' => 'form-control']) !!}
</div>
